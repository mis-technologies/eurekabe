<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('disk')->default('public');
            $table->string('entity')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->string('filename');
            $table->string('path');
            $table->string('extension')->nullable();
            $table->string('mime')->nullable();
            $table->string('identifier')->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->timestamps();

            $table->index(['entity', 'entity_id', 'identifier']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
