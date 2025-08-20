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
        Schema::create('pembiayaan_rincian_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembiayaan_pesanan_id')->constrained()->onDelete('cascade');

            $table->foreignId('barang_id')->constrained('barang')->onDelete('restrict');
            $table->date('tanggal');
            $table->string('deskripsi');
            $table->integer('kuantitas');
            $table->string('satuan');
            $table->decimal('biaya', 15, 2);

            $table->foreignId('proyek_id')->nullable()->constrained('proyek')->onDelete('set null');
            $table->foreignId('departemen_id')->nullable()->constrained('departemen')->onDelete('set null');

            // Jika gudang juga model sendiri
            $table->foreignId('gudang_id')->nullable()->constrained('gudang')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembiayaan_rincian_barangs');
    }
};
