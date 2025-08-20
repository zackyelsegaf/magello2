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
        Schema::create('pengiriman_penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->nullOnDelete();
            $table->string('no_pengiriman')->unique();
            $table->date('tgl_pengiriman');
            $table->string('no_po')->nullable();
            $table->string('status')->default('draft');

            $table->string('no_pelanggan')->nullable();
            $table->string('nama_pelanggan')->nullable();
            $table->text('deskripsi')->nullable();

            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            // $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->nullOnDelete();
            $table->unsignedBigInteger('cabang_id')->nullable();

            $table->string('no_persetujuan')->nullable();
            $table->text('catatan_pemeriksaan')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->boolean('disetujui')->default(false);
            $table->string('urgensi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_penjualans');
    }
};
