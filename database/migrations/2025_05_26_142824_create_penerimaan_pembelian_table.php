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
        Schema::create('penerimaan_pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('no_penerimaan')->nullable();
            $table->string('no_persetujuan')->nullable();
            $table->string('no_pemasok')->nullable();
            $table->string('no_formulir')->nullable();
            $table->string('pemasok_penerimaan')->nullable();
            $table->string('tgl_penerimaan')->nullable();
            $table->string('deskripsi_penerimaan')->nullable();
            $table->string('departemen')->nullable();
            $table->string('gudang')->nullable();
            $table->string('proyek')->nullable();
            $table->boolean('tindak_lanjut_check')->nullable()->default(false);
            $table->boolean('urgent_check')->nullable()->default(false);
            $table->boolean('catatan_pemeriksaan_check')->nullable()->default(false);
            $table->boolean('disetujui_check')->nullable()->default(false);
            $table->string('deskripsi_1')->nullable();
            $table->string('deskripsi_2')->nullable();
            $table->string('status_penerimaan')->nullable();
            $table->string('pengguna_penerimaan')->nullable();
            $table->string('fileupload_1')->nullable();
            $table->string('fileupload_2')->nullable();
            $table->string('fileupload_3')->nullable();
            $table->string('fileupload_4')->nullable();
            $table->string('fileupload_5')->nullable();
            $table->string('fileupload_6')->nullable();
            $table->string('fileupload_7')->nullable();
            $table->string('fileupload_8')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaan_pembelian');
    }
};
