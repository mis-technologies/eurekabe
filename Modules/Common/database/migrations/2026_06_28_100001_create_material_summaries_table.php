<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained()->cascadeOnDelete();
            $table->enum('length_type', ['short', 'medium', 'detailed']);
            $table->longText('content');
            $table->timestamps();

            $table->unique(['material_id', 'length_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_summaries');
    }
};
