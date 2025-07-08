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
        Schema::create('spp_kaplings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spp_id')->constrained('surat_perintah_pembangunans')->onDelete('cascade');
            $table->foreignId('unit_property_id')->constrained('unit_properties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spp_kaplings');
    }
};
