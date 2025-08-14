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
        Schema::create('tipe_aktiva_tetap_pajaks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('metode_penyusutan_id')
                ->constrained('metode_penyusutans')
                ->onDelete('cascade')->nullable();
            $table->integer('umur_perkiraan')->default(0);
            $table->decimal('nilai_penyusutan', 15, 2)->default(0);
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
