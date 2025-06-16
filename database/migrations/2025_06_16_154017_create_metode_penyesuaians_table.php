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
        Schema::create('metode_penyesuaians', function (Blueprint $table) {
            $table->id();

            $table->string('nama');               // Label ditampilkan ke user
            $table->string('slug')->unique();     // Kode unik, internal system
            $table->boolean('butuh_pembulatan')->default(false);
            $table->integer('urutan')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metode_penyesuaians');
    }
};
