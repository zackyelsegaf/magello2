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
        Schema::create('transaksi_buku_kas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_kas_id')->constrained('buku_kas')->onDelete('cascade');
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_buku_kas')->onDelete('set null');
            $table->foreignId('tipe_id')->nullable()->constrained('tipe_buku_kas')->onDelete('set null');
            $table->unsignedBigInteger('nominal')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('referensi')->nullable(); // mis. "Pembayaran Konsumen #123"
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_buku_kas');
    }
};
