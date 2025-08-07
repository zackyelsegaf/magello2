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
        Schema::create('detail_penerimaans', function (Blueprint $table) {
            $table->id();

            // Foreign key ke penerimaan_penjualans
            $table->unsignedBigInteger('penerimaan_penjualan_id');
            $table->foreign('penerimaan_penjualan_id')
                  ->references('id')
                  ->on('penerimaan_penjualans')
                  ->onDelete('cascade');

            // Kolom berdasarkan header
            $table->string('no_faktur', 100)->nullable();             // No. Faktur
            $table->date('tgl_faktur')->nullable();                  // Tgl. Faktur
            $table->date('jatuh_tempo')->nullable();                 // Jatuh Tempo
            $table->decimal('jumlah', 18, 2)->nullable();            // Jumlah
            $table->decimal('diskon', 18, 2)->nullable();            // Diskon
            $table->decimal('terhutang', 18, 2)->nullable();         // Terhutang
            $table->decimal('jumlah_pembayaran', 18, 2)->nullable(); // Jumlah Pembayaran
            $table->boolean('bayar')->default(false);                // Bayar (checkbox/flag)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penerimaans');
    }
};
