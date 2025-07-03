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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->onDelete('cascade');
            $table->foreignId('tipe_pembayaran_id')->nullable()->constrained('tipe_pembayarans')->onDelete('restrict');
            $table->date('tanggal')->nullable();
            $table->decimal('nominal', 20, 2)->default(0);
            $table->text('catatan')->nullable();
            $table->foreignId('akun_id')->nullable()->constrained('akuns')->nullOnDelete(); // akun kas/bank
            $table->unsignedTinyInteger('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
