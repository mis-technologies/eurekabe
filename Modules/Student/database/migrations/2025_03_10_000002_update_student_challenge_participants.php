<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_challenge_participants', function (Blueprint $table) {
            // Fix score from integer to decimal to support fractional marks
            $table->decimal('score', 8, 2)->default(0)->change();

            // Prevent duplicate participant rows for the same challenge
            $table->unique(['challenge_id', 'user_id']);
        });
    }

    public function down(): void
    {
        // MySQL uses the unique index as the backing index for the challenge_id FK.
        // Drop the FK first, then the unique, then restore both.
        Schema::table('student_challenge_participants', function (Blueprint $table) {
            $table->dropForeign(['challenge_id']);
        });

        Schema::table('student_challenge_participants', function (Blueprint $table) {
            $table->dropUnique(['challenge_id', 'user_id']);
            $table->integer('score')->default(0)->change();
            $table->foreign('challenge_id')->references('id')->on('student_challenges');
        });
    }
};
