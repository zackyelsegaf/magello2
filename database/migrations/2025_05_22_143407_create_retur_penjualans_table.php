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
        Schema::create('retur_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_retur')->unique();
            $table->date('tgl_retur')->nullable();
            $table->string('no_faktur')->nullable(); // optional, relasi jika perlu
            $table->enum('status', ['draft', 'diproses', 'selesai', 'batal'])->default('draft');

            $table->string('no_pelanggan')->nullable(); // bisa FK ke tabel pelanggan
            $table->string('nama_pelanggan')->nullable();

            $table->decimal('nilai_faktur', 20, 2)->default(0);
            $table->text('deskripsi')->nullable();
            $table->boolean('tercetak')->default(false);

            $table->boolean('catatan_pemeriksaan')->default(false);
            $table->boolean('tindak_lanjut')->default(false);
            $table->boolean('disetujui')->default(false);

            $table->string('no_persetujuan')->nullable();
            $table->string('sumber')->nullable();

            $table->foreignId('user_id')->constrained('users')->onDelete('set null')->nullable();
            $table->foreignId('cabang_id')->constrained('cabangs')->onDelete('set null')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retur_penjualans');
    }
};
