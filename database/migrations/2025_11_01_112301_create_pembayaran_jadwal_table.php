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
        Schema::create('pembayaran_jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembayaran_id')->constrained('pembayaran_konsumen')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('jadwal_id')->constrained('jadwal_biaya_booking')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('amount_applied');
            $table->unique(['pembayaran_id', 'jadwal_id']);
            $table->index(['jadwal_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_jadwal');
    }
};
