<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            if (!Schema::hasColumn('competitions', 'winner_id')) {
                $table->foreignId('winner_id')->nullable()->after('school_id');
            }
            if (!Schema::hasColumn('competitions', 'status')) {
                $table->string('status')->default('upcoming')->after('instruction')
                    ->comment('upcoming, ongoing, completed');
            }
            if (!Schema::hasColumn('competitions', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropColumn(array_filter(['winner_id', 'status', 'deleted_at'], fn($c) => Schema::hasColumn('competitions', $c)));
        });
    }
};
