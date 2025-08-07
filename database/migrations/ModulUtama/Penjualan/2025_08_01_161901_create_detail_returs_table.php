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
        Schema::create('detail_returs', function (Blueprint $table) {
            $table->id();

            // Foreign key ke retur_penjualans
            $table->unsignedBigInteger('retur_penjualan_id');
            $table->foreign('retur_penjualan_id')
                ->references('id')
                ->on('retur_penjualans')
                ->onDelete('cascade');

            // Kolom berdasarkan header
            $table->string('no_barang', 100)->nullable();              // No. Barang
            $table->string('deskripsi_barang', 255)->nullable();       // Deskripsi Barang
            $table->integer('kts')->nullable();                        // Kts (Kuantitas)
            $table->string('satuan', 50)->nullable();                  // Satuan
            $table->decimal('harga_satuan', 15, 2)->nullable();        // Harga Satuan
            $table->decimal('diskon_persen', 5, 2)->nullable();        // Disk %
            $table->decimal('pajak', 5, 2)->nullable();                // Pajak
            $table->decimal('jumlah', 18, 2)->nullable();              // Jumlah (total setelah hitung diskon dan pajak)
            $table->string('departemen', 150)->nullable();             // Departemen
            $table->string('proyek', 150)->nullable();                 // Proyek
            $table->string('gudang', 150)->nullable();                 // Gudang

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_returs');
    }
};
