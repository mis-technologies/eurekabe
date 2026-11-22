<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('paystack_reference')->nullable()->change();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->enum('provider', ['paystack', 'apple'])->default('paystack')->after('plan_id');
            $table->string('apple_transaction_id')->nullable()->unique()->after('authorization_email');
            $table->string('apple_original_transaction_id')->nullable()->after('apple_transaction_id');
            $table->index('apple_original_transaction_id');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex(['apple_original_transaction_id']);
            $table->dropColumn(['provider', 'apple_transaction_id', 'apple_original_transaction_id']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->string('paystack_reference')->nullable(false)->change();
        });
    }
};
