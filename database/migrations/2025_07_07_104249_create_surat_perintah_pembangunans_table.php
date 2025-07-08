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
        Schema::create('surat_perintah_pembangunans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_spp')->unique();
            $table->unsignedTinyInteger('instruksi'); // 1 = marketing, 2 = manajemen
            $table->date('tanggal');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_perintah_pembangunans');
    }
};
