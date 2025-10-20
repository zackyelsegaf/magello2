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
        Schema::create('biaya_booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking_kavling')->onDelete('cascade');
            $table->foreignId('jenis_biaya_id')->constrained('jenis_biaya_konsumen')->onDelete('cascade');
            $table->string('nominal_biaya')->nullable();
            $table->boolean('use_diskon')->default(false)->index();
            $table->boolean('use_jadwal')->default(false)->index();
            $table->string('nominal_diskon')->nullable();
            $table->unique(['booking_id', 'jenis_biaya_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_booking');
    }
};
