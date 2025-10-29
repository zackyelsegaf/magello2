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
        Schema::create('booking_kavling', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kapling_id')->constrained('kapling')->onDelete('cascade');
            $table->foreignId('konsumen_id')->constrained('konsumen')->onDelete('cascade');
            $table->string('nomor_booking')->nullable();
            $table->string('tanggal_booking')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->unsignedTinyInteger('current_status_code')->nullable()->index()->comment();
            $table->foreignId('spr_id')->nullable()->constrained('surat_pemesanan_rumah')->onDelete('cascade');
            $table->unsignedTinyInteger('status_pengajuan')->default(0)->check('status_pengajuan BETWEEN 0 AND 7');
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
            $table->unique(['kapling_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_kavling');
    }
};
