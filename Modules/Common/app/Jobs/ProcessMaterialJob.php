<?php

namespace Modules\Common\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Modules\Common\Models\Material;
use Modules\Common\Notifications\Notification as EurekaNotification;

class ProcessMaterialJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 600;
    public int $tries   = 1;   // extraction is deterministic; retrying a timeout just wastes the worker

    public function __construct(public int $materialId) {}

    public function handle(): void
    {
        $material = Material::find($this->materialId);

        if (!$material || $material->status !== 'processing') {
            return;
        }

        $relative = $material->path;
        $disk     = Storage::disk('local');

        if (!$relative || !$disk->exists($relative)) {
            Log::error('ProcessMaterialJob: uploaded file missing', [
                'material_id' => $this->materialId,
                'path'        => $relative,
            ]);
            $this->markFailed($material);
            return;
        }

        $absolute = $disk->path($relative);

        try {
            $ext  = strtolower(pathinfo($absolute, PATHINFO_EXTENSION));
            $text = $ext === 'pdf' ? $this->extractPdf($absolute) : (string) file_get_contents($absolute);

            if (trim((string) $text) === '') {
                $this->markFailed($material);
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
            throw $e; // failed() below marks the material failed + notifies
        } finally {
            // The file is only needed for extraction; discard it either way.
            $disk->delete($relative);
            $material->path = null;
            $material->saveQuietly();
        }
    }

    /** Also runs when the worker kills the job on timeout, so status can never stay "processing". */
    public function failed(?\Throwable $e): void
    {
        $material = Material::find($this->materialId);
        if ($material && $material->status === 'processing') {
            $this->markFailed($material);
        }
    }

    private function markFailed(Material $material): void
    {
        $material->update(['status' => 'failed']);
        $this->notifyUser($material, false);
    }

    private function extractPdf(string $path): string
    {
        // pdftotext (poppler) is fast, low-memory and handles encrypted PDFs; use it first.
        $text = $this->extractWithPdftotext($path);
        if ($text !== null && trim($text) !== '') {
            return $text;
        }

        // Fallback to the pure-PHP parser (e.g. if poppler isn't installed).
        return (new \Smalot\PdfParser\Parser())->parseFile($path)->getText();
    }

    private function extractWithPdftotext(string $path): ?string
    {
        try {
            $process = new Process(['pdftotext', '-enc', 'UTF-8', '-layout', $path, '-']);
            $process->setTimeout(120);
            $process->run();

            return $process->isSuccessful() ? $process->getOutput() : null;
        } catch (\Throwable $e) {
            Log::error('ProcessMaterialJob: pdftotext failed', ['error' => $e->getMessage()]);
            return null;
        }
    }

    private function notifyUser(Material $material, bool $success): void
    {
        $user = $material->user;
        if (!$user) {
            return;
        }

        $title = $material->title ?? 'Your material';

        if ($success) {
            $dbContent = [
                'title'     => 'Material Ready',
                'text'      => "\"{$title}\" has been processed and is ready for study.",
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
