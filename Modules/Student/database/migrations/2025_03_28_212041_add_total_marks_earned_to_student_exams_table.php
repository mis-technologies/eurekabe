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
        Schema::table('student_exams', function (Blueprint $table) {
            $table->decimal('total_marks_earned', 8, 2)->after('ended_at')->nullable();
            $table->integer('total_correct')->after('total_marks_earned')->nullable();
            //total_questions, pass_percentage, total_possible_marks, passed
            $table->decimal('pass_percentage', 8, 2)->after('total_correct')->nullable();
            $table->integer('total_questions')->after('pass_percentage')->nullable();
            $table->decimal('total_possible_marks', 8, 2)->after('total_questions')->nullable();
            $table->string('passed')->after('total_possible_marks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_exams', function (Blueprint $table) {
            $table->dropColumn('total_marks_earned');
            $table->dropColumn('total_correct');
            $table->dropColumn('pass_percentage');
            $table->dropColumn('total_questions');
            $table->dropColumn('total_possible_marks');
            $table->dropColumn('passed');

        });
    }
};
