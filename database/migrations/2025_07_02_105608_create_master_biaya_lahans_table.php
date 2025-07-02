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
        Schema::create('master_biaya_lahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_biaya');
            $table->foreignId('akun_perolehan_id')->constrained('akun')->onDelete('restrict');
            $table->foreignId('akun_closing_id')->constrained('akun')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_biaya_lahans');
    }
};
