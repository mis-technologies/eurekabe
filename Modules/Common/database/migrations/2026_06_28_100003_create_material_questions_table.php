<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained()->cascadeOnDelete();
            $table->text('question');
            $table->enum('question_type', ['mcq', 'theory']);
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->json('options')->nullable()->comment('Array of 4 option strings for MCQ');
            $table->text('correct_answer')->nullable()->comment('A/B/C/D for MCQ; model answer for theory');
            $table->text('explanation')->nullable();
            $table->timestamps();

            $table->index(['material_id', 'question_type', 'difficulty']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_questions');
    }
};
