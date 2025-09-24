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
        Schema::create('fasos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cluster_id')->nullable()->constrained('cluster')->onDelete('cascade');
            $table->foreignId('rap_rab_id')->nullable()->constrained('rap_rab')->onDelete('cascade');
            $table->string('tipe_model')->nullable();
            $table->string('blok_fasos')->nullable();
            $table->string('nomor_unit_fasos')->nullable();
            $table->string('jumlah_lantai')->nullable();
            $table->string('luas_tanah')->nullable();
            $table->string('luas_bangunan')->nullable();
            $table->string('harga_fasos')->nullable();
            $table->string('status_penjualan')->nullable();
            $table->string('status_pembangunan')->nullable();
            $table->string('spesifikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasos');
    }
};
