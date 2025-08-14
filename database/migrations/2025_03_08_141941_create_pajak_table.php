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
        Schema::create('pajak', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // Contoh: P, H
            $table->string('nama'); // Contoh: PPN 11%
            $table->decimal('nilai_persentase', 5, 2); // Contoh: 11.00, 2.00

            // Relasi akun (optional jika ada tabel 'akun')
            // $table->string('akun_pajak_penjualan')->nullable(); // Misal 210301
            // $table->string('akun_pajak_pembelian')->nullable(); // Misal 110701

            // Atau bisa pakai foreign key kalau tabel akun tersedia:
            $table->foreignId('akun_pajak_penjualan_id')->nullable()->constrained('akun')->nullOnDelete();
            $table->foreignId('akun_pajak_pembelian_id')->nullable()->constrained('akun')->nullOnDelete();

            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pajak');
    }
};
