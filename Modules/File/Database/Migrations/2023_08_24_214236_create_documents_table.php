<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->text('name')->nullable(); //drivers licence or text
            $table->text('reference')->nullable(); // e.g type=bvn 76231i231239
            $table->string('type')->nullable(); // drivers_license,international_passport, bvn
            $table->string('entity')->nullable(); // UserDriver, UserCarrier 
            $table->string('entity_id')->nullable();            
            $table->integer('active')->nullable()->default(1); // indicate if document is in use
            $table->string('status')->nullable()->default('reviewing'); // reviewing, approved, rejected, 
            $table->integer('is_verified')->default(0);
            $table->integer('is_kyc')->default(0)->nullable();
            $table->foreignId('is_verified_by')->nullable(); //admin that verified
            $table->date('verified_at')->nullable(); //date verified

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
