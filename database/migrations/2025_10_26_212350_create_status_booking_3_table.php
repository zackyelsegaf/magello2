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
        Schema::create('status_booking_3', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking_kavling')->onDelete('cascade');
            $table->string('nomor_sp3k')->nullable();
            $table->date('tanggal_sp3k')->nullable();
            $table->string('file_sp3k')->nullable();
            $table->string('plafond_sp3k')->nullable();
            $table->string('cicilan_sp3k')->nullable();
            $table->string('tenor_sp3k')->nullable();
            $table->string('bank_sp3k', 150)->nullable();
            $table->string('program_subsidi', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_booking_3');
    }
};
