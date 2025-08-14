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
        Schema::create('siklus_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique(); // contoh: Harian, Mingguan, Bulanan
            $table->unsignedTinyInteger('jumlah_hari')->nullable(); // Optional: durasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siklus_pembayarans');
    }
};
