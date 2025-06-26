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
        Schema::create('pembiayaan_pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->date('tanggal');
            $table->foreignId('akun_id')->constrained('akun')->onDelete('restrict');
            $table->text('deskripsi')->nullable();

            // Kolom pemeriksaan
            $table->boolean('urgent')->default(false);
            $table->text('tindak_lanjut')->nullable();
            $table->text('catatan_pemeriksaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembiayaan_pesanans');
    }
};
