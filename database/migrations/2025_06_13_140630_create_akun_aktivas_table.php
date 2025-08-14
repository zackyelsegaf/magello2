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
        Schema::create('akun_aktivas', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();      // Contoh: Tanah, Bangunan, Kendaraan
            $table->string('slug')->unique();      // Contoh: tanah, bangunan, kendaraan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_aktivas');
    }
};
