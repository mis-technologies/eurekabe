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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['virtual', 'in_person'])->default('virtual');
            $table->dateTime('start_datetime'); // Stores both date & time
            $table->dateTime('end_datetime');
            $table->string('location');
            $table->string('image');
            $table->string('price');
            $table->text('description');
            $table->json('speakers')->nullable();
            $table->json('sponsors')->nullable();
            $table->text('special_bonus')->nullable();
            $table->enum('status', ['UPCOMING', 'PAST EVENT'])->default('UPCOMING');
            $table->string('reg_link')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
