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
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id();
            $table->string('no_jurnal')->unique();
            $table->date('tanggal');
            $table->string('no_cek')->nullable();
            $table->string('sumber')->nullable();
            $table->boolean('mata_uang_asing')->default(false);
            $table->boolean('urgent')->default(false);
            $table->text('tindak_lanjut')->nullable();
            $table->text('catatan_pemeriksaan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('cabang')->nullable();
            $table->integer('nilai')->nullable();
            $table->string('no_persetujuan')->nullable();
            $table->boolean('disetujui')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal');
    }
};
