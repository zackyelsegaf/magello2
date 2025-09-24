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
        Schema::create('akun', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipe_id')->constrained('tipe_akun')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('akun')->onDelete('set null');
            $table->string('no_akun')->nullable();
            $table->string('nama_akun_indonesia')->nullable();
            $table->string('nama_akun_inggris')->nullable();
            $table->boolean('sub_akun_check')->nullable()->default(false);
            $table->foreignId('mata_uang_id')->nullable()->constrained('mata_uang')->onDelete('set null');
            $table->string('saldo_akun')->nullable();
            $table->string('tanggal')->nullable();
            $table->boolean('dihentikan')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};
