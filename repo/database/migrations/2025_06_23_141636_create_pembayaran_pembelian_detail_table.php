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
        Schema::create('pembayaran_pembelian_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembayaran_pembelian_id')->constrained('pembayaran_pembelian')->onDelete('cascade');
            $table->string('akun_bank')->nullable();
            $table->string('nilai_tukar')->nullable();
            $table->string('mata_uang')->nullable();
            $table->string('tgl_cek')->nullable();
            $table->boolean('bayar_check')->nullable()->default(false);
            $table->string('no_cek')->nullable();
            $table->string('jumlah_check')->nullable();
            $table->string('saldo_bank')->nullable();
            $table->string('no_faktur')->nullable();
            $table->string('tgl_faktur')->nullable();
            $table->string('jatuh_tempo')->nullable();
            $table->string('pph_23')->nullable();
            $table->string('diskon')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('terhutang')->nullable();
            $table->string('jumlah_pembayaran')->nullable();
            $table->string('deskripsi_rincian')->nullable();
            $table->string('alamat_pemasok')->nullable();
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_pembelian_detail');
    }
};
