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
        Schema::create('metode_penyusutans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');               // Contoh: Garis Lurus
            $table->string('slug')->unique();     // Slug unik untuk URL atau referensi
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metode_penyusutans');
    }
};
