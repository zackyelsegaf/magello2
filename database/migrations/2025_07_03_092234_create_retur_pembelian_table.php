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
        Schema::create('retur_pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('no_retur')->nullable();
            $table->string('no_persetujuan')->nullable();
            $table->string('tgl_retur')->nullable(); 
            $table->string('no_formulir')->nullable();
            $table->string('no_pemasok')->nullable();
            $table->string('pemasok_retur')->nullable(); 
            $table->string('departemen')->nullable();
            $table->string('gudang')->nullable();
            $table->string('proyek')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('ppn_11_persen')->nullable();
            $table->string('pajak_2')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('status_retur')->nullable(); 
            $table->string('pengguna_retur')->nullable(); 
            $table->boolean('pajak_check')->nullable()->default(false);
            $table->boolean('termasuk_pajak_check')->nullable()->default(false);
            $table->boolean('disetujui_check')->nullable()->default(false);
            $table->string('deskripsi')->nullable();
            $table->string('no_faktur')->nullable();
            $table->string('nilai_tukar_pajak')->nullable();
            $table->string('nilai_tukar')->nullable();
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
        Schema::dropIfExists('retur_pembelian');
    }
};
