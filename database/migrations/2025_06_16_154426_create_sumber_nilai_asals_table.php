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
        Schema::create('sumber_nilai_asals', function (Blueprint $table) {
            $table->id();
            $table->string('nama');          // Label yang ditampilkan ke UI
            $table->string('slug')->unique(); // e.g. nilai_sekarang, harga_lama_1
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
        Schema::dropIfExists('sumber_nilai_asals');
    }
};
