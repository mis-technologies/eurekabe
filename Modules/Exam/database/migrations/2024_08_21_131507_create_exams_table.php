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
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('subject_id');
            $table->string('title', 191);
            $table->text('instruction');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedInteger('negative_marking')->nullable()->default(0)->comment('1 = yes, 0 = no');
            $table->unsignedInteger('reduce_mark')->nullable()->comment('mark will be reduce for wrong answer');
            $table->unsignedInteger('pass_percentage')->comment('pass mark percentage for exam');
            $table->unsignedInteger('duration')->comment('exam duration time');
            $table->unsignedInteger('totalmark')->nullable()->comment('exam total mark');
            $table->unsignedInteger('value')->nullable()->comment('1=> paid, 2 => unpaid');
            $table->unsignedInteger('exam_fee')->nullable()->comment('exam fee');
            $table->unsignedInteger('random_question')->default(0)->comment('questions will be random or not, 1=yes, 0= no');
            $table->unsignedInteger('option_suffle')->default(0)->comment('question options will be suffle or , not , 1 = yes, 0= no');
            $table->string('image')->nullable();
            $table->integer('question_type')->nullable()->comment('1 => MCQ, 2 => Written');
            $table->unsignedBigInteger('school_id')->default(10);
            $table->integer('status')->comment('1 = active, 2 =inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
