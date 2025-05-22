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
        Schema::create('faktur_penagihans', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur')->unique();
            $table->date('tgl_faktur');
            $table->text('deskripsi')->nullable();
            $table->string('status')->default('draft');
            $table->decimal('nilai_faktur', 15, 2);
            $table->string('no_pelanggan');
            $table->string('nama_pelanggan');
            $table->decimal('uang_muka', 15, 2)->default(0);
            $table->string('pengguna');
            $table->string('cabang');
            $table->string('no_persetujuan')->nullable();
            $table->text('catatan_pemeriksaan')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->boolean('disetujui')->default(false);
            $table->string('urgensi')->default('normal');
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->nullOnDelete();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faktur_penagihans');
    }
};
