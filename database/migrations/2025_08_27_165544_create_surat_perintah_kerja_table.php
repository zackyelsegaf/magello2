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
        Schema::create('surat_perintah_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pekerja_id')->constrained('pekerja_simandor')->onDelete('restrict');
            $table->foreignId('spp_id')->constrained('surat_perintah_pembangunan')->onDelete('cascade');
            $table->string('nomor_spk')->nullable();
            $table->string('judul_spk')->nullable();
            $table->string('tanggal_spk')->nullable();
            $table->string('fileupload')->nullable();
            $table->string('tanggal_mulai')->nullable();
            $table->string('status_spk')->nullable();
            $table->string('lama_pengerjaan')->nullable();
            $table->string('siklus_pembayaran')->nullable();
            $table->string('tipe_pembayaran')->nullable();
            $table->string('dibuat_oleh')->nullable();
            $table->string('disetujui_oleh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_perintah_kerja');
    }
};
