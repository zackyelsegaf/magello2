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
        Schema::create('detail_faktur_penagihans', function (Blueprint $table) {
            $table->id();

            // Foreign key ke faktur_penagihans
            $table->unsignedBigInteger('faktur_penagihan_id');
            $table->foreign('faktur_penagihan_id')
                  ->references('id')
                  ->on('faktur_penagihans')
                  ->onDelete('cascade');

            // Kolom berdasarkan header
            $table->string('no_faktur', 100)->nullable();                 // No Faktur
            $table->date('tgl_faktur')->nullable();                      // Tgl Faktur
            $table->date('tgl_jatuh_tempo_faktur')->nullable();          // Tgl Jatuh Tempo Faktur
            $table->decimal('total_faktur', 18, 2)->nullable();          // Total Faktur
            $table->decimal('terhutang', 18, 2)->nullable();             // Terhutang
            $table->string('deskripsi_faktur', 255)->nullable();         // Deskripsi Faktur
            $table->string('catatan', 255)->nullable();                  // Catatan

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_faktur_penagihans');
    }
};
