<?php

namespace Modules\Common\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\Common\Models\Material;
use Modules\Common\Notifications\Notification as EurekaNotification;

class ProcessMaterialJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 180;
    public int $tries   = 2;

    public function __construct(public int $materialId) {}

    public function handle(): void
    {
        $material = Material::with('file')->find($this->materialId);

        if (!$material || $material->status !== 'processing') {
            return;
        }

        $file = $material->file;

        if (!$file) {
            $material->update(['status' => 'failed']);
            $this->notifyUser($material, false);
            return;
        }

        try {
            $ext        = strtolower($file->extension);
            $isRemote   = $file->disk === 'cloudinary';

            if ($ext === 'pdf') {
                $tmpPath = tempnam(sys_get_temp_dir(), 'mat_') . '.pdf';

                // For Cloudinary the path is a URL; for local disks get an absolute path
                if ($isRemote) {
                    $contents = file_get_contents($file->path);
                } else {
                    $contents = Storage::disk($file->disk)->get($file->path);
                }

                if ($contents === null || $contents === false) {
                    Log::error('ProcessMaterialJob: file contents could not be retrieved', [
                        'material_id' => $this->materialId,
                        'disk'        => $file->disk,
                        'path'        => $file->path,
                    ]);
                    $material->update(['status' => 'failed']);
                    $this->notifyUser($material, false);
                    return;
                }

                file_put_contents($tmpPath, $contents);

                $parser = new \Smalot\PdfParser\Parser();
                $pdf    = $parser->parseFile($tmpPath);
                $text   = $pdf->getText();

                @unlink($tmpPath);
            } else {
                $text = $isRemote
                    ? file_get_contents($file->path)
                    : Storage::disk($file->disk)->get($file->path);
            }

            if (!$text || trim($text) === '') {
                $material->update(['status' => 'failed']);
                $this->notifyUser($material, false);
                return;
            }

            if (strlen($text) > 100000) {
                $text = substr($text, 0, 100000)
                    . "\n\n[Note: Document was truncated to 100,000 characters.]";
            }

            $material->update([
                'extracted_text' => $text,
                'word_count'     => str_word_count($text),
                'status'         => 'ready',
            ]);

            $this->notifyUser($material, true);
        } catch (\Throwable $e) {
            Log::error('ProcessMaterialJob: extraction failed', [
                'material_id' => $this->materialId,
                'error'       => $e->getMessage(),
            ]);
            $material->update(['status' => 'failed']);
            $this->notifyUser($material, false);
            throw $e; // allow queue to record the failure and retry
        }
    }

    private function notifyUser(Material $material, bool $success): void
    {
        $user = $material->user;
        if (!$user) {
            return;
        }

        $title = $material->name ?? 'Your material';

        if ($success) {
            $dbContent = [
                'title'     => 'Material Ready',
                'text'      => "\"{$title}\" has been processed and is ready for study.',",
                'entity'    => get_class($material),
                'entity_id' => $material->id,
                'meta'      => ['material_id' => $material->id],
            ];
        } else {
            $dbContent = [
                'title'     => 'Material Processing Failed',
                'text'      => "We couldn't process \"{$title}\". Please try uploading again.",
                'entity'    => get_class($material),
                'entity_id' => $material->id,
                'meta'      => ['material_id' => $material->id],
            ];
        }

        try {
            $user->notify(new EurekaNotification(null, $dbContent, ['database', 'push']));
        } catch (\Throwable $e) {
            Log::error('ProcessMaterialJob: failed to send notification', ['error' => $e->getMessage()]);
        }
    }
}
