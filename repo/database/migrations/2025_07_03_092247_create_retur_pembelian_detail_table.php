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
        Schema::create('retur_pembelian_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('retur_pembelian_id')->constrained('retur_pembelian')->onDelete('cascade');
            $table->string('no_barang')->nullable();
            $table->string('deskripsi_barang')->nullable();
            $table->string('kts_barang')->nullable();
            $table->string('satuan')->nullable();
            $table->string('harga_satuan')->nullable();
            $table->string('diskon_barang')->nullable();
            $table->string('kode_pajak')->nullable();
            $table->string('jumlah_total_harga')->nullable();
            $table->string('reserve_1')->nullable();
            $table->string('reserve_2')->nullable();
            $table->string('reserve_3')->nullable();
            $table->string('alamat_pajak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retur_pembelian_detail');
    }
};
