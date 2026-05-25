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
        Schema::table('student_challenge_participants', function (Blueprint $table) {
            $table->dropUnique(['challenge_id', 'user_id']);
            $table->integer('score')->default(0)->change();
        });
    }
};
