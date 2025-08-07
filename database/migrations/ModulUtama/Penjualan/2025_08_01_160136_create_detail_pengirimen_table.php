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
        Schema::create('detail_pengirimen', function (Blueprint $table) {
            $table->id();

            // Foreign key
            $table->unsignedBigInteger('pengiriman_penjualan_id');
            $table->foreign('pengiriman_penjualan_id')
                  ->references('id')
                  ->on('pengiriman_penjualans')
                  ->onDelete('cascade');

            // Fields from header
            $table->string('no_barang', 100)->nullable();           // No. Barang
            $table->string('deskripsi_barang', 255)->nullable();    // Deskripsi Barang
            $table->integer('kts')->nullable();                     // Kts
            $table->string('satuan', 50)->nullable();               // Satuan
            $table->decimal('diskon_persen', 5, 2)->nullable();     // Disk %
            $table->string('departemen', 150)->nullable();          // Departemen
            $table->string('proyek', 150)->nullable();              // Proyek
            $table->string('no_pesanan', 100)->nullable();          // No. Pesanan
            $table->string('no_penawaran', 100)->nullable();        // No. Penawaran
            $table->string('gudang', 150)->nullable();              // Gudang

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengirimen');
    }
};
