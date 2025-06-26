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
        Schema::dropIfExists('penawaran_penjualans');
        Schema::create('penawaran_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_penawaran')->unique();
            $table->date('tgl_penawaran')->nullable();
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->nullOnDelete();
            $table->foreignId('penjual_id')->nullable()->constrained('penjual')->nullOnDelete();
            $table->string('no_pelanggan')->nullable();
            $table->string('nama_pelanggan')->nullable();
            $table->string('status')->default('draft');

            $table->decimal('nilai_diskon', 15, 2)->default(0);
            $table->decimal('total_pajak', 15, 2)->default(0);
            $table->decimal('nilai_pajak_1', 15, 2)->default(0);
            $table->decimal('nilai_pajak_2', 15, 2)->default(0);
            $table->decimal('nilai_penawaran', 15, 2)->default(0);

            $table->text('deskripsi')->nullable();

            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            // $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->nullOnDelete();

            $table->string('no_persetujuan')->nullable();
            $table->text('catatan_pemeriksaan')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->boolean('disetujui')->default(false);
            $table->string('urgensi')->nullable(); // bisa: rendah, sedang, tinggi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawaran_penjualans');
    }
};
