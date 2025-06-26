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
        Schema::create('pesanan_penjualan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_penjualan_id')->constrained('pesanan_penjualans')->onDelete('cascade');
            $table->foreignId('item_id')->constrained(
                table: 'barang',
                indexName: 'item_id'
            );
            $table->string('deskripsi_barang')->nullable();
            $table->integer('kuantitas')->default(0); // Kts
            $table->string('satuan', 50)->nullable();
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->decimal('diskon_persen', 5, 2)->default(0); // Disk %
            $table->decimal('pajak', 15, 2)->default(0);
            $table->decimal('jumlah', 15, 2)->default(0);
            $table->integer('kuantitas_dikirim')->default(0);
            $table->string('departemen')->nullable();
            $table->string('proyek')->nullable();
            $table->string('no_penawaran')->nullable(); // bisa jadi foreign key ke tabel penawaran_penjualan
            $table->string('reserve_1')->nullable();
            $table->string('reserve_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_penjualan_items');
    }
};
