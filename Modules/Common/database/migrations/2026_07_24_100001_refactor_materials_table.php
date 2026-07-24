<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Refactor materials table:
 * - Add file_id (FK to files — the uploaded document)
 * - Add summary columns (short / medium / detailed) folded in from material_summaries
 * - Add resources JSON column folded in from material_resources
 * - Make path + original_filename nullable (kept for backward compat, superseded by file_id)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            // Link to the uploaded File record
            $table->foreignId('file_id')->nullable()->after('user_id')->constrained('files')->nullOnDelete();

            // Fold material_summaries into columns
            $table->longText('summary_short')->nullable()->after('extracted_text');
            $table->longText('summary_medium')->nullable()->after('summary_short');
            $table->longText('summary_detailed')->nullable()->after('summary_medium');

            // Fold material_resources into a JSON column
            $table->json('resources')->nullable()->after('summary_detailed');

            // Make legacy columns nullable (superseded by File model)
            $table->string('path')->nullable()->change();
            $table->string('original_filename')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['file_id']);
            $table->dropColumn(['file_id', 'summary_short', 'summary_medium', 'summary_detailed', 'resources']);
            $table->string('path')->nullable(false)->change();
            $table->string('original_filename')->nullable(false)->change();
        });
    }
};
