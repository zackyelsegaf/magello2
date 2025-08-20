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
        Schema::create('tipe_aktiva_tetaps', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_aktiva')->nullable(); // Nama aktiva tetap
            $table->string('slug')->unique(); // Slug untuk URL
            $table->foreignId('tipe_aktiva_tetap_pajak_id')
                ->constrained('tipe_aktiva_tetap_pajaks')
                ->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_aktiva_tetaps');
    }
};
