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
        Schema::create('pembayaran_lainnya', function (Blueprint $table) {
            $table->id();
            $table->string('no_pembayaran')->unique();
            $table->date('tanggal');
            $table->string('no_cek')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('nilai_tukar')->nullable()->default(1);
            $table->foreignId('dibayar_dari_akun_id')->nullable()->constrained('akun')->onDelete('cascade');
            $table->text('dibayar_ke')->nullable();
            $table->string('rancangan')->nullable();
            $table->boolean('mata_uang_asing')->default(false);
            $table->boolean('urgent')->default(false);
            $table->text('tindak_lanjut')->nullable();
            $table->text('catatan_pemeriksaan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('cabang')->nullable();
            $table->integer('nilai')->nullable();
            $table->string('no_persetujuan')->nullable();
            $table->boolean('disetujui')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_lainnya');
    }
};
