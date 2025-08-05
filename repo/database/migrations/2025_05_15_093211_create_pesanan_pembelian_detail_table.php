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
        Schema::create('pesanan_pembelian_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_pembelian_id')->constrained('pesanan_pembelian')->onDelete('cascade');
            $table->string('no_barang')->nullable();
            $table->string('deskripsi_barang')->nullable();
            $table->string('kts_pesanan')->nullable();
            $table->string('satuan')->nullable();
            $table->string('harga_satuan')->nullable();
            $table->string('diskon_barang')->nullable();
            $table->string('pajak')->nullable();
            $table->string('jumlah_total_harga')->nullable();
            $table->string('kts_diterima')->nullable();
            $table->string('gudang')->nullable();
            $table->string('departemen')->nullable();
            $table->string('proyek')->nullable();
            $table->string('no_permintaan')->nullable();
            $table->string('alamat_pemasok')->nullable();
            $table->string('alamat_pengiriman')->nullable();
            $table->string('tgl_ekspektasi')->nullable();
            $table->string('syarat')->nullable();
            $table->string('kirim_melalui')->nullable();
            $table->string('fob')->nullable();
            $table->string('nilai_tukar')->nullable();
            $table->string('uang_muka')->nullable();
            $table->string('uang_muka_terpakai')->nullable();
            $table->boolean('tutup_check_detail')->nullable()->default(false);
            $table->boolean('uang_muka_check')->nullable()->default(false);
            $table->string('akun_uang_muka')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_pembelian_detail');
    }
};
