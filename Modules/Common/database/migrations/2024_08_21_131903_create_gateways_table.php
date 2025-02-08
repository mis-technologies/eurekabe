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
        Schema::create('gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->nullable();
            $table->string('alias', 191)->default('NULL');
            $table->string('image', 191)->nullable();
            $table->string('name', 191);
            $table->boolean('status')->default(true);
            $table->text('parameters')->nullable();
            $table->text('supported_currencies')->nullable();
            $table->boolean('crypto')->default(false)->comment('0: fiat currency, 1: crypto currency');
            $table->text('extra')->nullable();
            $table->text('description')->nullable();
            $table->text('input_form')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateways');
    }
};
