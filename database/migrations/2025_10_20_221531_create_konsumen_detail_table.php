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
        Schema::create('konsumen_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsumen_id')->nullable()->constrained('konsumen')->onDelete('cascade');
            $table->foreignId('pekerjaan_2_id')->nullable()->constrained('tipe_pelanggan')->onDelete('cascade');
            $table->string('nama_2')->nullable();
            $table->string('nik_2')->nullable();
            $table->string('no_hp_2')->nullable();
            $table->string('tempat_lahir_2')->nullable();
            $table->string('tanggal_lahir_2')->nullable();
            $table->string('npwp_2')->nullable();
            
            $table->string('provinsi_code_2')->nullable();
            $table->string('kota_code_2')->nullable();
            $table->string('kecamatan_code_2')->nullable();
            $table->string('kelurahan_code_2')->nullable();
            $table->foreign('provinsi_code_2')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_2')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_2')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'districts')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_2')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'villages')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('alamat_2')->nullable();

            $table->string('provinsi_code_3')->nullable();
            $table->string('kota_code_3')->nullable();
            $table->string('kecamatan_code_3')->nullable();
            $table->string('kelurahan_code_3')->nullable();
            $table->foreign('provinsi_code_3')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_3')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_3')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'districts')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_3')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'villages')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('alamat_3')->nullable();

            $table->string('provinsi_code_4')->nullable();
            $table->string('kota_code_4')->nullable();
            $table->string('kecamatan_code_4')->nullable();
            $table->string('kelurahan_code_4')->nullable();
            $table->foreign('provinsi_code_4')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_4')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_4')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'districts')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_4')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'villages')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('alamat_4')->nullable();

            $table->string('provinsi_code_5')->nullable();
            $table->string('kota_code_5')->nullable();
            $table->string('kecamatan_code_5')->nullable();
            $table->string('kelurahan_code_5')->nullable();
            $table->foreign('provinsi_code_5')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_5')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_5')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'districts')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_5')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'villages')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('alamat_5')->nullable();

            $table->string('provinsi_code_6')->nullable();
            $table->string('kota_code_6')->nullable();
            $table->string('kecamatan_code_6')->nullable();
            $table->string('kelurahan_code_6')->nullable();
            $table->foreign('provinsi_code_6')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_6')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_6')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'districts')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_6')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'villages')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('alamat_6')->nullable();

            $table->string('provinsi_code_7')->nullable();
            $table->string('kota_code_7')->nullable();
            $table->string('kecamatan_code_7')->nullable();
            $table->string('kelurahan_code_7')->nullable();
            $table->foreign('provinsi_code_7')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_7')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_7')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'districts')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_7')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'villages')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('alamat_7')->nullable();
            $table->string('nama_perusahaan_1')->nullable();
            $table->string('bidang_usaha_1')->nullable();
            $table->string('jabatan_1')->nullable();
            $table->string('status_pekerjaan_1')->nullable();
            $table->string('tanggal_mulai_kerja_1')->nullable();
            $table->string('gaji_pokok_1')->nullable();
            $table->string('cycle_gaji_pokok_1')->nullable();
            $table->string('gaji_tambahan_1')->nullable();
            $table->string('daftar_cicilan_1')->nullable();
            $table->string('nama_usaha_1')->nullable();
            $table->string('bidang_wirausaha_1')->nullable();
            $table->string('lama_usaha_1')->nullable();
            $table->string('legalitas_1')->nullable();
            $table->string('pendapatan_kotor_1')->nullable();
            $table->string('pendapatan_bersih_1')->nullable();
            $table->string('pendapatan_tambahan_1')->nullable();
            $table->string('daftar_cicilan_wirausaha_1')->nullable();

            $table->string('nama_perusahaan_2')->nullable();
            $table->string('bidang_usaha_2')->nullable();
            $table->string('jabatan_2')->nullable();
            $table->string('status_pekerjaan_2')->nullable();
            $table->string('tanggal_mulai_kerja_2')->nullable();
            $table->string('gaji_pokok_2')->nullable();
            $table->string('cycle_gaji_pokok_2')->nullable();
            $table->string('gaji_tambahan_2')->nullable();
            $table->string('daftar_cicilan_2')->nullable();
            $table->string('nama_usaha_2')->nullable();
            $table->string('bidang_wirausaha_2')->nullable();
            $table->string('lama_usaha_2')->nullable();
            $table->string('legalitas_2')->nullable();
            $table->string('pendapatan_kotor_2')->nullable();
            $table->string('pendapatan_bersih_2')->nullable();
            $table->string('pendapatan_tambahan_2')->nullable();
            $table->string('daftar_cicilan_wirausaha_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsumen_detail');
    }
};
