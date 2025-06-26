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
        Schema::create('aktiva_tetap_items', function (Blueprint $table) {
            $table->id();
             $table->foreignId('aktiva_tetap_id')->constrained('aktiva_tetap')->onDelete('cascade');
            $table->foreignId('akun_id')->constrained('akun')->onDelete('restrict');
            $table->decimal('nilai', 15, 2);
            $table->boolean('rekonsiliasi')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktiva_tetap_items');
    }
};
