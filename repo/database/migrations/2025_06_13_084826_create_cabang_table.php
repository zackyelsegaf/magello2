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
        Schema::create('cabang', function (Blueprint $table) {
            $table->id();
            $table->string('cabang_id')->nullable();
            $table->string('nama_cabang')->nullable();
            $table->string('kode_transaksi')->nullable();
            $table->string('proyek')->nullable();
            $table->string('gudang')->nullable();
            $table->string('pengguna')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabang');
    }
};
