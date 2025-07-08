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
        Schema::create('master_biaya_konsumens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');

            $table->foreignId('tipe_pembayaran_id')->constrained('tipe_pembayarans')->onDelete('cascade');
            $table->foreignId('kategori_pembayaran_id')->constrained('kategori_pembayarans')->onDelete('cascade');

            // Akun Pembayaran Kustomer
            // Akun Pembayaran Kustomer
            $table->foreignId('akun_pembayaran_kustomer_debit')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->foreignId('akun_pembayaran_kustomer_kredit')->nullable()->constrained('akuns')->onDelete('cascade');

            // Akun Piutang
            $table->foreignId('akun_piutang_debit')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->foreignId('akun_piutang_kredit')->nullable()->constrained('akuns')->onDelete('cascade');

            // Akun Closing Unit
            $table->foreignId('akun_closing_unit_debit')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->foreignId('akun_closing_unit_kredit')->nullable()->constrained('akuns')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_biaya_konsumens');
    }
};
