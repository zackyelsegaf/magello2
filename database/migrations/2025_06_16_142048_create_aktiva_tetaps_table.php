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
        Schema::create('aktiva_tetaps', function (Blueprint $table) {
            $table->id();
            $table->string('kode_aktiva')->unique();
            $table->foreignId('tipe_aktiva_id')->constrained('tipe_aktiva_tetaps')->onDelete('restrict');
            $table->string('deskripsi_aktiva');
            $table->foreignId('departemen_id')->constrained('departemen')->onDelete('restrict');
            $table->date('tgl_akuisisi');
            $table->date('tgl_penggunaan');
            $table->string('memo');
            $table->foreignId('metode_penyusutan_id')->constrained('metode_penyusutan')->onDelete('restrict');
            $table->foreignId('akun_aktiva_id')->constrained('akun_aktivas')->onDelete('restrict'); // Akun Aktivasi
            $table->foreignId('akun_akumulasi_penyusutan_id')->constrained('akun_akumulasi_penyusutans')->onDelete('restrict');
            $table->foreignId('akun_biaya_penyusutan_id')->constrained('akun_biaya_penyusutans')->onDelete('restrict');
            $table->integer('umur_tahun')->default(0);
            $table->integer('umur_bulan')->default(0);
            $table->decimal('persen_penyusutan', 5, 2)->default(0); // Contoh: 5.00%
            $table->decimal('biaya_aktiva', 15, 2);
            $table->decimal('nilai_penyusutan', 15, 2)->default(0);
            $table->decimal('nilai_buku', 15, 2)->default(0);
            $table->decimal('nilai_sisa', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktiva_tetaps');
    }
};
