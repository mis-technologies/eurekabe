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
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('method_code');
            $table->decimal('amount', 18, 8);
            $table->string('method_currency', 191);
            $table->decimal('charge', 18, 8);
            $table->decimal('rate', 18, 8);
            $table->decimal('final_amo', 18, 8)->nullable()->default(0);
            $table->text('detail')->nullable();
            $table->string('btc_amo', 191)->nullable();
            $table->string('btc_wallet', 191)->nullable();
            $table->string('trx', 191)->nullable();
            $table->integer('try')->default(0);
            $table->integer('exam_id')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1=>success, 2=>pending, 3=>cancel');
            $table->string('admin_feedback', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
