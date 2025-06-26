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
        Schema::create('jenis_hargas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');           // Contoh: Harga 1, Minimal Harga Jual
            $table->string('slug')->unique(); // Contoh: harga_1, min_harga_jual
            $table->enum('tipe', ['jual', 'beli', 'diskon'])->default('jual');
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_hargas');
    }
};
