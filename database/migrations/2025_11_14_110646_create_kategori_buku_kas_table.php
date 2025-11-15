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
        Schema::create('kategori_buku_kas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');       // e.g. "Penjualan", "Gaji", "Transfer"
            $table->foreignId('tipe_id')->constrained('tipe_buku_kas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_buku_kas');
    }
};
