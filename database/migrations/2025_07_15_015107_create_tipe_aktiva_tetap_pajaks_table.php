x<?php

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
        Schema::create('tipe_aktiva_tetap_pajaks', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_aktiva_tetap_pajak')->nullable();
            $table->string('metode_penyusutan')->nullable();
            $table->string('umur_perkiraan')->nullable();
            $table->string('nilai_penyusutan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_aktiva_tetap_pajaks');
    }
};
