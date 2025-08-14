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
        Schema::create('pencatatan_nomor_serials', function (Blueprint $table) {
            $table->id();

            $table->string('tipe_transaksi'); // Contoh: Faktur Penjualan
            $table->string('transaksi_no');   // No. Transaksi / Faktur
            $table->string('no_pengisian');   // Nomor Pengisian
            $table->date('tgl_pengisian');
            $table->string('disiapkan_oleh');
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_nomor_serials');
    }
};
