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
        Schema::create('unit_properties', function (Blueprint $table) {
            $table->id();
            // Relasi
            $table->foreignId('cluster_id')->constrained('cluster')->onDelete('cascade');
            // $table->foreignId('rap_rab_id')->nullable()->constrained('rap_rab')->nullOnDelete();
            $table->unsignedBigInteger('rap_rab_id')->nullable();

            // Penentu tipe
            $table->unsignedTinyInteger('tipe_model')->nullable();

            // Info unit umum
            $table->string('blok')->nullable();
            $table->string('nomor_unit')->nullable();
            $table->integer('jumlah_lantai')->nullable();
            $table->decimal('luas_tanah', 10, 2)->nullable();
            $table->decimal('luas_bangunan', 10, 2)->nullable();
            $table->decimal('harga', 15, 2)->nullable();
            $table->text('spesifikasi')->nullable();

            // Khusus fasilitas umum & sosial
            $table->string('nama_fasilitas')->nullable();

            // Status penjualan (optional)
            $table->unsignedTinyInteger('status_penjualan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_properties');
    }
};
