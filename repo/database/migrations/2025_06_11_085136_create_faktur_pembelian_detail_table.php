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
        Schema::create('faktur_pembelian_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faktur_pembelian_id')->constrained('faktur_pembelian')->onDelete('cascade');
            $table->string('no_barang')->nullable();
            $table->string('deskripsi_barang')->nullable();
            $table->string('kts_faktur')->nullable();
            $table->string('satuan')->nullable();
            $table->string('harga_satuan')->nullable();
            $table->string('diskon_barang')->nullable();
            $table->string('kode_pajak')->nullable();
            $table->string('jumlah_total_harga')->nullable();
            $table->string('no_permintaan')->nullable();
            $table->string('no_pesanan')->nullable();
            $table->string('no_penerimaan')->nullable();
            $table->string('reserve_1')->nullable();
            $table->string('reserve_2')->nullable();
            $table->string('reserve_3')->nullable();
            $table->string('no_akun')->nullable();
            $table->string('nama_akun')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('catatan')->nullable();
            $table->boolean('alokasi_barang_check')->nullable()->default(false);
            $table->boolean('alokasi_pemasok_check')->nullable()->default(false);
            $table->boolean('beban_tagihan_check')->nullable()->default(false);
            $table->boolean('pajak_inklusif_check')->nullable()->default(false);
            $table->boolean('tutup_check_detail')->nullable()->default(false);
            $table->string('nama_pemasok_detail')->nullable();
            $table->string('no_faktur_detail')->nullable();
            $table->string('tanggal_detail')->nullable();
            $table->string('no_faktur_pajak')->nullable();
            $table->string('alamat_pemasok')->nullable();
            $table->string('tgl_kirim')->nullable();
            $table->string('kirim_melalui')->nullable();
            $table->string('fob')->nullable();
            $table->string('nilai_tukar')->nullable();
            $table->string('nilai_tukar_pajak')->nullable();
            $table->string('tgl_pajak')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('total_uang_muka')->nullable();
            $table->string('tgl_uang_muka')->nullable();
            $table->string('kode_pajak_uang_muka')->nullable();
            $table->string('pajak_1')->nullable();
            $table->string('pajak_2')->nullable();
            $table->string('no_faktur_uang_muka')->nullable();
            $table->string('no_po')->nullable();
            $table->string('nilai_tukar_uang_muka')->nullable();
            $table->string('nilai_tukar_pajak_uang_muka')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faktur_pembelian_detail');
    }
};
