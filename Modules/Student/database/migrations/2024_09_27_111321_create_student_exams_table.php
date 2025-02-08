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
        Schema::create('student_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->boolean('payment_required')->default(false);
            $table->boolean('is_paid')->nullable(); //If the exam requires payment before results can be released'
            $table->integer('attempts')->nullable();

            $table->date('started_at')->nullable();
            $table->date('ended_at')->nullable();
            
            $table->longText('questions')->nullable();

            $table->string('status')->comment('started, submitted, awaiting_result, result_released');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exams');
    }
};
