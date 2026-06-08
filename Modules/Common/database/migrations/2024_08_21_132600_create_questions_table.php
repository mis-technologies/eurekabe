<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete();
            $table->text('question');
            $table->decimal('marks', 8, 2)->default(1);
            $table->foreignId('question_type_id')->constrained('question_types');
            $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');
            $table->text('written_ans')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
