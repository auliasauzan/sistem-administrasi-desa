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
        Schema::create('land_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('residents')->onDelete('cascade');
            $table->string('certificate_number')->unique();
            $table->float('area_size');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_certificates');
    }
};
