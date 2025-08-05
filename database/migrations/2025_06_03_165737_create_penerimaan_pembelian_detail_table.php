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
        Schema::create('penerimaan_pembelian_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerimaan_pembelian_id')->constrained('penerimaan_pembelian')->onDelete('cascade');
            $table->string('no_barang')->nullable();
            $table->string('deskripsi_barang')->nullable();
            $table->string('kts_penerimaan')->nullable();
            $table->string('satuan')->nullable();
            $table->string('alamat_pemasok')->nullable();
            $table->string('tgl_kirim')->nullable();
            $table->string('kirim_melalui')->nullable();
            $table->string('fob')->nullable();
            $table->string('no_pesanan')->nullable();
            $table->string('no_permintaan')->nullable();
            $table->string('kts_faktur')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('harga_satuan')->nullable();
            $table->string('diskon_barang')->nullable();
            $table->string('kode_pajak')->nullable();
            $table->string('jumlah_total_harga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaan_pembelian_detail');
    }
};
