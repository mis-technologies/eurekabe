<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->default(0)->after('type')->comment('Entry fee in lowest currency unit (kobo for NGN)');
            $table->string('timezone')->default('UTC')->after('price')->comment('Per-competition timezone for window calculation');
            $table->unsignedTinyInteger('window_start_hour')->default(0)->after('timezone')->comment('0-23, hour in competition timezone');
            $table->unsignedTinyInteger('window_end_hour')->default(1)->after('window_start_hour')->comment('0-23, hour in competition timezone');
        });
    }

    public function down(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropColumn(['price', 'timezone', 'window_start_hour', 'window_end_hour']);
        });
    }
};
