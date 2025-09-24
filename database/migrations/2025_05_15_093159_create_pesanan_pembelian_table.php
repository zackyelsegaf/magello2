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
        Schema::create('pesanan_pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('no_pesanan')->nullable();
            $table->string('no_persetujuan')->nullable();
            $table->string('no_cnt_pesanan')->nullable();
            $table->string('no_pemasok')->nullable();
            $table->string('pemasok_pesanan')->nullable();
            $table->string('tgl_pesanan')->nullable();
            $table->string('deskripsi_pesanan')->nullable();
            $table->string('nilai_tukar')->nullable();
            $table->boolean('tindak_lanjut_check')->nullable()->default(false);
            $table->boolean('urgent_check')->nullable()->default(false);
            $table->boolean('catatan_pemeriksaan_check')->nullable()->default(false);
            $table->boolean('pajak_check')->nullable()->default(false);
            $table->boolean('termasuk_pajak_check')->nullable()->default(false);
            $table->boolean('tutup_check')->nullable()->default(false);
            $table->boolean('disetujui_check')->nullable()->default(false);
            $table->string('deskripsi_1')->nullable();
            $table->string('deskripsi_2')->nullable();
            $table->string('status_pesanan')->nullable();
            $table->string('pengguna_pesanan')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('diskon_left')->nullable();
            $table->string('total_diskon_right')->nullable();
            $table->string('ppn_11_persen')->nullable();
            $table->string('pajak_2')->nullable();
            $table->string('estimasi_biaya')->nullable();
            $table->string('jumlah')->nullable();
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
        Schema::dropIfExists('pesanan_pembelian');
    }
};
