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
        Schema::create('pembayaran_konsumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking_kavling')->cascadeOnDelete();
            $table->foreignId('jenis_biaya_konsumen_id')->constrained('jenis_biaya_konsumen')->restrictOnDelete();
            $table->foreignId('akun_id')->constrained('akun')->restrictOnDelete();
            $table->string('nomor_referensi')->unique();
            $table->date('tanggal_pembayaran')->nullable();
            $table->unsignedBigInteger('nominal_pembayaran');
            $table->text('catatan_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->boolean('is_approved')->default(false)->index();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->date('approved_at')->nullable();
            $table->foreignId('changed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->index(['booking_id', 'jenis_biaya_konsumen_id']);
            $table->index(['akun_id']);
            $table->index(['tanggal_pembayaran']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_konsumen');
    }
};
