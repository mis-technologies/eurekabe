<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Drop the now-redundant material sub-tables:
 * - material_summaries  → replaced by summary_short/medium/detailed columns on materials
 * - material_resources  → replaced by resources JSON column on materials
 *
 * material_questions is kept — it remains the storage model for AI-generated
 * practice questions (future: migrate to Exam + Question + QuestionOption).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('material_summaries');
        Schema::dropIfExists('material_resources');
    }

    public function down(): void
    {
        // Restore via the original create migrations if needed
    }
};
