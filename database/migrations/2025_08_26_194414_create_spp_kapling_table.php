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
        Schema::create('spp_kapling', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spp_id')->constrained('surat_perintah_pembangunan')->onDelete('cascade');
            $table->foreignId('kapling_id')->constrained('kapling')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spp_kapling');
    }
};
