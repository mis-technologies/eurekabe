<?php

namespace Modules\Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'user_id',
        'file_id',
        'title',
        'original_filename', // kept nullable for legacy rows
        'path',              // kept nullable for legacy rows
        'extracted_text',
        'word_count',
        'status',
        'summary_short',
        'summary_medium',
        'summary_detailed',
        'resources',
    ];

    protected $casts = [
        'resources' => 'array',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** The uploaded document stored via FileFacade + Cloudinary */
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    /** AI-generated practice exam (private, linked via exams.material_id) */
    public function practiceExam()
    {
        return $this->hasOne(Exam::class, 'material_id');
    }

    /** AI-generated practice questions stored in material_questions */
    public function questions()
    {
        return $this->hasMany(MaterialQuestion::class);
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    public function isReady(): bool
    {
        return $this->status === 'ready';
    }

    public function isProcessing(): bool
    {
        return $this->status === 'processing';
    }

    public function summary(string $length): ?string
    {
        return match ($length) {
            'medium'   => $this->summary_medium,
            'detailed' => $this->summary_detailed,
            default    => $this->summary_short,
        };
    }

    public function setSummary(string $length, string $content): void
    {
        $this->update(["summary_{$length}" => $content]);
    }

    /** Filename as stored in the linked File record, or original_filename fallback */
    public function getDisplayFilenameAttribute(): string
    {
        return $this->file?->filename ?? $this->original_filename ?? '';
    }
}
