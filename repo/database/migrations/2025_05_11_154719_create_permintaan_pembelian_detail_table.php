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
        Schema::create('permintaan_pembelian_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permintaan_pembelian_id')->constrained('permintaan_pembelian')->onDelete('cascade');
            $table->string('no_barang')->nullable();
            $table->string('deskripsi_barang')->nullable();
            $table->string('kts_permintaan')->nullable();
            $table->string('satuan')->nullable();
            $table->string('catatan')->nullable();
            $table->string('tgl_diminta')->nullable();
            $table->string('kts_dipesan')->nullable();
            $table->string('kts_diterima')->nullable();
            $table->string('harga_satuan')->nullable();
            $table->string('jumlah_total_harga')->nullable();
            $table->boolean('tutup_check_all')->nullable()->default(false);
            $table->boolean('tutup_check_items')->nullable()->default(false);
            $table->boolean('detail_check')->nullable()->default(false);
            $table->boolean('tutup_check_detail')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_pembelian_detail');
    }
};
