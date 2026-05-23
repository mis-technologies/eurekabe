<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('competition_participants', function (Blueprint $table) {
            if (!Schema::hasColumn('competition_participants', 'score')) {
                $table->unsignedInteger('score')->default(0)->after('payment_id');
            }
            if (!Schema::hasColumn('competition_participants', 'submitted_at')) {
                $table->timestamp('submitted_at')->nullable()->after('score');
            }
        });
    }

    public function down(): void
    {
        Schema::table('competition_participants', function (Blueprint $table) {
            $cols = array_filter(['score', 'submitted_at'], fn($c) => Schema::hasColumn('competition_participants', $c));
            if ($cols) $table->dropColumn(array_values($cols));
        });
    }
};
