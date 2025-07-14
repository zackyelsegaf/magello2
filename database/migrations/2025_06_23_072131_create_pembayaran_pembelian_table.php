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
        Schema::create('pembayaran_pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('no_pembayaran')->nullable();
            $table->string('no_persetujuan')->nullable();
            $table->string('no_pemasok')->nullable();
            $table->string('no_formulir')->nullable();
            $table->string('pemasok_pembayaran')->nullable();
            $table->string('tgl_pembayaran')->nullable();
            $table->boolean('cek_kosong_check')->nullable()->default(false);
            $table->boolean('disetujui_check')->nullable()->default(false);
            $table->boolean('pajak_check')->nullable()->default(false);
            $table->string('status_pembayaran')->nullable();
            $table->string('pengguna_pembayaran')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('diskon_left')->nullable();
            $table->string('total_diskon_right')->nullable();
            $table->string('ppn_11_persen')->nullable();
            $table->string('pajak_2')->nullable();
            $table->string('jumlah_biaya')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('gudang')->nullable();
            $table->string('departemen')->nullable();
            $table->string('proyek')->nullable();
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
        Schema::dropIfExists('pembayaran_pembelian');
    }
};
