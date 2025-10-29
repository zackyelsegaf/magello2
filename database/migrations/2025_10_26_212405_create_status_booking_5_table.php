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
        Schema::create('status_booking_5', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking_kavling')->onDelete('cascade');
            $table->date('tanggal_ajb')->nullable();
            $table->text('catatan_ajb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_booking_5');
    }
};
