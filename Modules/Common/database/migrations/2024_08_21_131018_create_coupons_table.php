<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('details');
            $table->integer('amount_type')->comment('1 = percentage, 2 = neat amount');
            $table->decimal('coupon_amount', 18, 8);
            $table->decimal('min_order_amount', 18, 8)->nullable();
            $table->string('coupon_code');
            $table->integer('use_limit')->nullable();
            $table->integer('usage_per_user')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('status')->default(0)->comment('1 = active, 0 = inactive');
            $table->integer('exam_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
