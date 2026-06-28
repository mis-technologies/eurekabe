<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_credit_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained('credit_plans');
            $table->unsignedInteger('balance')->default(0);
            $table->unsignedInteger('monthly_allowance')->comment('Credits refilled each reset cycle');
            $table->dateTime('next_reset_at')->comment('When balance will next be refilled to monthly_allowance');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_credit_accounts');
    }
};
