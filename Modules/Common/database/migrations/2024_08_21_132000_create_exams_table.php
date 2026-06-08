<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->nullable();
            $table->foreignId('subject_id')->nullable();
            $table->string('title');
            $table->string('exam_name')->nullable();
            $table->string('exam_fee')->nullable();
            $table->text('instruction')->nullable();
            $table->decimal('totalmark', 8, 2)->nullable();
            $table->decimal('pass_percentage', 5, 2)->nullable();
            $table->boolean('show_review')->default(true);
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->integer('duration')->nullable();
            $table->string('status')->default('1')->comment('1=active, 2=inactive');
            $table->enum('visibility', ['public', 'private', 'followers'])->default('public')->comment('Visibility of the exam for schools');
            $table->integer('question_type')->nullable()->comment('1=MCQ, 2=Written');
            $table->integer('value')->default(2);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
