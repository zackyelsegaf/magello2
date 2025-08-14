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
        Schema::dropIfExists('penawaran_penjualan_items');
        Schema::create('penawaran_penjualan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penawaran_penjualan_id')->constrained('penawaran_penjualans')->onDelete('cascade');
            $table->foreignId('item_id')->constrained(
                table: 'barang',
                indexName: 'item_id'
            );
            $table->decimal('kts_permintaan', 15, 2)->nullable();
            $table->string('satuan', 50)->nullable();
            $table->decimal('harga_satuan', 15, 2)->nullable();
            $table->decimal('diskon', 15, 2)->nullable();
            $table->decimal('pajak', 15, 2)->nullable();
            $table->decimal('jumlah', 15, 2)->nullable();
            $table->decimal('kts_dipesan', 15, 2)->nullable();
            $table->decimal('kts_dikirim', 15, 2)->nullable();
            $table->string('departemen', 100)->nullable();
            $table->string('proyek', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawaran_penjualan_items');
    }
};
