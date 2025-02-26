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
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            $table->json('herosection'); 
            $table->json('pathnersection');
            $table->json('whoarewe');
            $table->json('socialsection');
            $table->json('whatweoffer');
            $table->json('teamsection');
            $table->json('downloadsection');
            $table->json('engagementsection');
          
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
