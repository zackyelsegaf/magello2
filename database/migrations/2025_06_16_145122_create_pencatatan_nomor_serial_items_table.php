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
        Schema::create('pencatatan_nomor_serial_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pencatatan_nomor_serial_id')->constrained('pencatatan_nomor_serials')->onDelete('cascade');
            $table->string('no_barang');
            $table->string('deskripsi')->nullable();
            $table->integer('kuantitas');
            $table->string('satuan');
            $table->string('serial_number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_nomor_serial_items');
    }
};
