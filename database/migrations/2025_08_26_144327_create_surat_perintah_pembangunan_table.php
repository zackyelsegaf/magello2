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
        Schema::create('surat_perintah_pembangunan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_spp')->unique();
            $table->date('tanggal_spp')->nullable();
            $table->string('catatan')->nullable();
            $table->boolean('konsumen')->nullable()->default(false);
            $table->boolean('stok')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_perintah_pembangunan');
    }
};
