<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_exam_id')->nullable();
            $table->foreignId('exam_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('question_id')->nullable();
            $table->longText('answer')->nullable();
            $table->foreignId('answer_type')->nullable(); // objective, 'german, essay
            $table->double('mark');
            $table->boolean('is_correct');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exam_results');
    }
};
