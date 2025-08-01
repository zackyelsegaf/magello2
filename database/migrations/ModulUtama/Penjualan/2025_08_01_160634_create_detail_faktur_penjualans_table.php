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
        Schema::create('detail_faktur_penjualans', function (Blueprint $table) {
            $table->id();

            // Informasi Barang
            $table->string('no_barang', 100)->nullable();           // No. Barang
            $table->string('deskripsi_barang', 255)->nullable();    // Deskripsi Barang
            $table->integer('kts')->nullable();                     // Kts (Kuantitas)
            $table->string('satuan', 50)->nullable();               // Satuan
            $table->decimal('harga_satuan', 15, 2)->nullable();     // Harga Satuan
            $table->decimal('diskon_persen', 5, 2)->nullable();     // Disk %
            $table->decimal('pajak', 5, 2)->nullable();             // Pajak
            $table->decimal('jumlah', 18, 2)->nullable();           // Jumlah total (harga * qty - diskon + pajak)

            // Informasi Organisasi
            $table->string('gudang', 200)->nullable();              // Gudang
            $table->string('proyek', 150)->nullable();              // Proyek
            $table->string('departemen', 150)->nullable();          // Departemen

            // Cadangan / Tambahan
            $table->string('reserve_1', 100)->nullable();           // Reserve 1
            $table->string('reserve_2', 100)->nullable();           // Reserve 2

            // Referensi Nomor
            $table->string('no_pengiriman', 100)->nullable();       // No. Pengiriman
            $table->string('no_pesanan', 100)->nullable();          // No. Pesanan
            $table->string('no_penawaran', 100)->nullable();        // No. Penawaran

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_faktur_penjualans');
    }
};
