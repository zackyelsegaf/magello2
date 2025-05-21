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
        Schema::create('faktur_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur');
            $table->date('tgl_faktur');
            $table->text('deskripsi')->nullable();
            $table->string('status')->nullable();
            $table->decimal('nilai_faktur', 18, 2)->default(0);
            $table->unsignedBigInteger('pelanggan_id');
            $table->string('no_pelanggan')->nullable();
            $table->string('nama_pelanggan')->nullable();
            $table->decimal('uang_muka', 18, 2)->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->string('no_persetujuan')->nullable();
            $table->boolean('catatan_pemeriksaan')->default(false);
            $table->boolean('tindak_lanjut')->default(false);
            $table->boolean('disetujui')->default(false);
            $table->string('urgensi')->nullable();
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faktur_penjualans');
    }
};
