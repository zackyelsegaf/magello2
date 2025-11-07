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
        Schema::create('jadwal_biaya_booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biaya_booking_id')->constrained('biaya_booking')->onDelete('cascade');
            $table->unsignedInteger('urutan')->default(0)->index();
            $table->string('tanggal_bayar')->nullable();
            $table->string('nominal_pembayaran')->nullable();
            $table->unique(['biaya_booking_id', 'urutan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_biaya_booking');
    }
};
