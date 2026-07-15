<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('credit_plans', function (Blueprint $table) {
            $table->enum('type', ['monthly', 'pay_as_you_go'])->default('monthly')->after('slug');
            $table->boolean('rollover')->default(false)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('credit_plans', function (Blueprint $table) {
            $table->dropColumn(['type', 'rollover']);
        });
    }
};
