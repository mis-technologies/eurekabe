<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_feature_costs', function (Blueprint $table) {
            $table->id();
            $table->string('feature_key')->unique()->comment('e.g. material_summary_short, ai_hint');
            $table->unsignedInteger('credits')->comment('Credits deducted per use (or per unit when multiplied)');
            $table->string('description');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_feature_costs');
    }
};
