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
        Schema::create('harga_jual_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('harga_jual_id')->constrained('harga_jual')->onDelete('cascade');

            $table->string('kode_barang');
            $table->string('deskripsi_barang')->nullable();
            $table->string('satuan')->nullable();
            $table->decimal('biaya_aktual', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_jual_items');
    }
};
