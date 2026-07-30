<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('competition_participants', function (Blueprint $table) {
            $table->timestamp('started_at')->nullable()->after('submitted_at')->comment('When participant opened/started the competition');
            $table->timestamp('paid_at')->nullable()->after('started_at')->comment('When payment was confirmed');
            $table->string('payment_method')->nullable()->after('paid_at')->comment('paystack, free, etc');
            $table->string('paystack_reference')->nullable()->after('payment_method')->comment('Paystack transaction reference for paid competitions');
        });
    }

    public function down(): void
    {
        Schema::table('competition_participants', function (Blueprint $table) {
            $table->dropColumn(['started_at', 'paid_at', 'payment_method', 'paystack_reference']);
        });
    }
};
