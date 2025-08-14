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
        Schema::create('unit_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                 // Unit 1, Unit 2, Box, Dus, dll
            $table->string('slug')->unique();       // unit-1, unit-2, box, dus, dll
            $table->integer('urutan')->default(1);  // Untuk pengurutan dropdown
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_barangs');
    }
};
