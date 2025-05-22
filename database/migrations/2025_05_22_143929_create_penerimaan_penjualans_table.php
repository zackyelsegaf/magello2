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
        Schema::create('penerimaan_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_formulir')->unique();
            $table->date('tgl_penerimaan')->nullable();
            $table->date('tgl_cek')->nullable();

            $table->string('no_pelanggan')->nullable();
            $table->string('nama_pelanggan')->nullable();

            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_cek')->default(0);
            $table->decimal('diskon', 20, 2)->default(0);

            $table->boolean('catatan_pemeriksaan')->default(false);
            $table->boolean('tindak_lanjut')->default(false);
            $table->boolean('disetujui')->default(false);
            $table->boolean('urgensi')->default(false);

            $table->string('no_persetujuan')->nullable();

            $table->foreignId('user_id')->constrained('users')->onDelete('set null')->nullable();
            $table->foreignId('cabang_id')->constrained('cabangs')->onDelete('set null')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaan_penjualans');
    }
};
