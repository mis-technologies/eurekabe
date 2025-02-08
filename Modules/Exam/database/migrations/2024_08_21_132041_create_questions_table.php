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
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('exam_id');
            $table->text('question');
            $table->double('marks')->unsigned();
            $table->text('written_ans')->nullable()->comment('when exam type is written this field is fillable');
            $table->foreignId('question_type_id')->default(1);
            $table->integer('status')->comment('1 = Active, 2 = Pending');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
