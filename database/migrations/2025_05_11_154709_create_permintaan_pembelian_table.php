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
        Schema::create('permintaan_pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('no_permintaan')->nullable();
            $table->string('no_persetujuan')->nullable();
            $table->string('tgl_permintaan')->nullable();
            $table->string('deskripsi_permintaan')->nullable();
            $table->string('pengguna_permintaan')->nullable();
            $table->boolean('tindak_lanjut_check')->nullable()->default(false);
            $table->boolean('urgent_check')->nullable()->default(false);
            $table->string('deskripsi_1')->nullable();
            $table->boolean('catatan_pemeriksaan_check')->nullable()->default(false);
            $table->string('deskripsi_2')->nullable();
            $table->string('status_permintaan')->nullable();
            $table->string('proyek')->nullable();
            $table->string('gudang')->nullable();
            $table->string('departemen')->nullable();
            $table->boolean('disetujui_check')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_pembelian');
    }
};
