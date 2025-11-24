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
        Schema::table('home_pages', function (Blueprint $table) {
            if (!Schema::hasColumn('home_pages', 'show_volunteer_call')) {
                $table->boolean('show_volunteer_call')->default(false)->after('engagementsection');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            if (Schema::hasColumn('home_pages', 'show_volunteer_call')) {
                $table->dropColumn('show_volunteer_call');
            }
        });
    }
};
