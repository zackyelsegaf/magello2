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
        Schema::create('tiket_konsumens', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique()->nullable(); // contoh: T2023070001
            $table->date('tanggal')->nullable();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('set null')->nullable();
            $table->string('unit')->nullable();
            $table->foreignId('kategori_id')->constrained('kategori_tiket_konsumen')->onDelete('restrict');
            $table->string('tujuan')->nullable(); // ex: PROJECT
            $table->text('deskripsi')->nullable();

            $table->unsignedTinyInteger('status')->nullable();
            $table->boolean('is_selesai')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket_konsumens');
    }
};
