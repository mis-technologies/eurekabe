<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id(); // Auto-increment integer for the primary key
                $table->string('name'); // Name of the category
                $table->string('slug')->unique(); // Unique slug for the category
                $table->unsignedTinyInteger('status'); // Status of the category
                $table->timestamps(); // Created at and updated at timestamps
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};