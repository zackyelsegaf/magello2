<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsip_files', function (Blueprint $table) {
            $table->id();
            $table->morphs('arsipmultimenu');
            $table->string('nama_arsip')->nullable();
            $table->string('nomor_arsip')->nullable();
            $table->date('tanggal_arsip')->nullable();
            $table->string('disk', 50)->default('public');
            $table->string('file_arsip');
            $table->text('keterangan_arsip')->nullable();
            $table->string('original_name')->nullable();
            $table->string('mime_type', 191)->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
            $table->index('tanggal_arsip');
            $table->index('nomor_arsip');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_files');
    }
};
