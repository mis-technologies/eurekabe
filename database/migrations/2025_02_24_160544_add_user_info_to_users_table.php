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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('cgpa', 8, 5)->nullable();
            $table->string('gender')->nullable();
            $table->string('refereed_by')->nullable();
            $table->longText('leading_attribute')->nullable();
            $table->longText('leading_experience')->nullable();
            $table->string('position')->nullable();
            $table->integer('level')->nullable();
            // $table->string('institution')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cgpa');
            $table->dropColumn('gender');
            $table->dropColumn('refereed_by');
            $table->dropColumn('leading_attribute');
            $table->dropColumn('leading_experience');
            $table->dropColumn('position');
            $table->dropColumn('level');
        });
    }
};
