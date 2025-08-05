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
        Schema::create('stok_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->nullable()->constrained('barang')->onDelete('cascade');
            $table->foreignId('gudang_id')->nullable()->constrained('gudang')->onDelete('cascade');
            $table->string('jumlah')->default(0);
            $table->unique(['barang_id', 'gudang_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_barang');
    }
};
