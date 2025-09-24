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
        Schema::create('pesanan_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_pesanan')->unique();
            $table->date('tgl_pesanan')->nullable();
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->nullOnDelete();

            $table->string('no_pelanggan')->nullable();
            $table->string('nama_pelanggan')->nullable();

            $table->string('status')->default('draft');
            $table->string('no_po')->nullable();

            $table->decimal('nilai_diskon', 15, 2)->default(0);
            $table->decimal('total_pajak', 15, 2)->default(0);
            $table->decimal('nilai_pajak_1', 15, 2)->default(0);
            $table->decimal('nilai_pajak_2', 15, 2)->default(0);
            $table->decimal('nilai_pesanan', 15, 2)->default(0);
            $table->decimal('uang_muka', 15, 2)->default(0);
            $table->decimal('uang_muka_terpakai', 15, 2)->default(0);

            $table->text('deskripsi')->nullable();

            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('cabang_id')->nullable();

            $table->string('no_persetujuan')->nullable();
            $table->text('catatan_pemeriksaan')->nullable();
            $table->text('tindak_lanjut')->nullable();

            $table->boolean('disetujui')->default(false);
            $table->string('urgensi')->nullable(); // ex: 'rendah', 'tinggi'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_penjualans');
    }
};
