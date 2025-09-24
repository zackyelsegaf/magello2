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
        Schema::create('spk_kapling', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spk_id')->constrained('surat_perintah_kerja')->onDelete('cascade');
            $table->foreignId('kapling_id')->constrained('kapling')->onDelete('restrict');
            $table->unique(['spk_id','kapling_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spk_kapling');
    }
};
