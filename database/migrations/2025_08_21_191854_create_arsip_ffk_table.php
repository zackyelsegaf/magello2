<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsip_ffk', function (Blueprint $table) {
            $table->id();
            $table->morphs('arsipmultimenu'); 
            $table->string('nama_arsip')->nullable();
            $table->string('nomor_arsip')->nullable();
            $table->date('tanggal_arsip')->nullable();
            $table->string('file_arsip')->nullable();
            $table->text('keterangan_arsip')->nullable();
            $table->string('original_name')->nullable();
            $table->string('mime_type', 100)->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_ffk');
    }
};
