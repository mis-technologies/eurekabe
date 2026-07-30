<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('competition_exams', function (Blueprint $table) {
            // Drop the incorrect FK (references student_exams instead of exams)
            $table->dropForeign(['exam_id']);

            // Add the correct FK referencing the exams (template) table
            $table->foreign('exam_id')->references('id')->on('exams')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('competition_exams', function (Blueprint $table) {
            $table->dropForeign(['exam_id']);
            $table->foreign('exam_id')->references('id')->on('student_exams')->cascadeOnDelete();
        });
    }
};
