<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('credit_plan_subscriptions', function (Blueprint $table) {
            $table->enum('provider', ['paystack', 'apple'])->default('paystack')->after('plan_id');
            $table->string('apple_original_transaction_id')->nullable()->after('provider');
            $table->index(['apple_original_transaction_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('credit_plan_subscriptions', function (Blueprint $table) {
            $table->dropIndex(['apple_original_transaction_id', 'status']);
            $table->dropColumn(['provider', 'apple_original_transaction_id']);
        });
    }
};
