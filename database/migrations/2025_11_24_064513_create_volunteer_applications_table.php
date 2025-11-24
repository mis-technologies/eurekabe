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
        Schema::create('volunteer_applications', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('university')->nullable();
            $table->string('course')->nullable();
            $table->string('graduation_year')->nullable();
            $table->longText('motivation')->nullable(); // Why they want to volunteer
            $table->longText('experience')->nullable(); // Previous leadership/volunteering experience
            $table->json('skills')->nullable(); // Skills they bring
            $table->enum('status', ['pending', 'under_review', 'approved', 'rejected'])->default('pending');
            $table->longText('admin_notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_applications');
    }
};
