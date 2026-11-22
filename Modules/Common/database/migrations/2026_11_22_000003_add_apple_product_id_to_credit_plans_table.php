<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('credit_plans', function (Blueprint $table) {
            $table->string('apple_product_id')->nullable()->unique()->after('slug');
        });
    }

    public function down(): void
    {
        Schema::table('credit_plans', function (Blueprint $table) {
            $table->dropColumn('apple_product_id');
        });
    }
};
