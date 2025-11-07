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
            $table->string('nama_2', 100)->nullable();
            $table->char('nik_2', 16)->nullable();
            $table->string('no_hp_2', 20)->nullable();
            $table->string('tempat_lahir_2', 100)->nullable();
            $table->date('tanggal_lahir_2')->nullable();
            $table->string('npwp_2', 25)->nullable();

            $table->char('provinsi_code_2', 2)->nullable();
            $table->char('kota_code_2', 4)->nullable();
            $table->char('kecamatan_code_2', 7)->nullable();
            $table->char('kelurahan_code_2', 10)->nullable();
            $table->text('alamat_2')->nullable();
            $table->foreign('provinsi_code_2')->references('code')->on(config('laravolt.indonesia.table_prefix').'provinces')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_2')->references('code')->on(config('laravolt.indonesia.table_prefix').'cities')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_2')->references('code')->on(config('laravolt.indonesia.table_prefix').'districts')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_2')->references('code')->on(config('laravolt.indonesia.table_prefix').'villages')->onUpdate('cascade')->onDelete('set null');

            $table->char('provinsi_code_3', 2)->nullable();
            $table->char('kota_code_3', 4)->nullable();
            $table->char('kecamatan_code_3', 7)->nullable();
            $table->char('kelurahan_code_3', 10)->nullable();
            $table->text('alamat_3')->nullable();
            $table->foreign('provinsi_code_3')->references('code')->on(config('laravolt.indonesia.table_prefix').'provinces')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_3')->references('code')->on(config('laravolt.indonesia.table_prefix').'cities')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_3')->references('code')->on(config('laravolt.indonesia.table_prefix').'districts')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_3')->references('code')->on(config('laravolt.indonesia.table_prefix').'villages')->onUpdate('cascade')->onDelete('set null');

            $table->char('provinsi_code_4', 2)->nullable();
            $table->char('kota_code_4', 4)->nullable();
            $table->char('kecamatan_code_4', 7)->nullable();
            $table->char('kelurahan_code_4', 10)->nullable();
            $table->text('alamat_4')->nullable();
            $table->foreign('provinsi_code_4')->references('code')->on(config('laravolt.indonesia.table_prefix').'provinces')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_4')->references('code')->on(config('laravolt.indonesia.table_prefix').'cities')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_4')->references('code')->on(config('laravolt.indonesia.table_prefix').'districts')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_4')->references('code')->on(config('laravolt.indonesia.table_prefix').'villages')->onUpdate('cascade')->onDelete('set null');

            $table->char('provinsi_code_5', 2)->nullable();
            $table->char('kota_code_5', 4)->nullable();
            $table->char('kecamatan_code_5', 7)->nullable();
            $table->char('kelurahan_code_5', 10)->nullable();
            $table->text('alamat_5')->nullable();
            $table->foreign('provinsi_code_5')->references('code')->on(config('laravolt.indonesia.table_prefix').'provinces')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_5')->references('code')->on(config('laravolt.indonesia.table_prefix').'cities')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_5')->references('code')->on(config('laravolt.indonesia.table_prefix').'districts')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_5')->references('code')->on(config('laravolt.indonesia.table_prefix').'villages')->onUpdate('cascade')->onDelete('set null');

            $table->char('provinsi_code_6', 2)->nullable();
            $table->char('kota_code_6', 4)->nullable();
            $table->char('kecamatan_code_6', 7)->nullable();
            $table->char('kelurahan_code_6', 10)->nullable();
            $table->text('alamat_6')->nullable();
            $table->foreign('provinsi_code_6')->references('code')->on(config('laravolt.indonesia.table_prefix').'provinces')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_6')->references('code')->on(config('laravolt.indonesia.table_prefix').'cities')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_6')->references('code')->on(config('laravolt.indonesia.table_prefix').'districts')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_6')->references('code')->on(config('laravolt.indonesia.table_prefix').'villages')->onUpdate('cascade')->onDelete('set null');

            $table->char('provinsi_code_7', 2)->nullable();
            $table->char('kota_code_7', 4)->nullable();
            $table->char('kecamatan_code_7', 7)->nullable();
            $table->char('kelurahan_code_7', 10)->nullable();
            $table->text('alamat_7')->nullable();
            $table->foreign('provinsi_code_7')->references('code')->on(config('laravolt.indonesia.table_prefix').'provinces')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_7')->references('code')->on(config('laravolt.indonesia.table_prefix').'cities')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_7')->references('code')->on(config('laravolt.indonesia.table_prefix').'districts')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_7')->references('code')->on(config('laravolt.indonesia.table_prefix').'villages')->onUpdate('cascade')->onDelete('set null');

            $table->string('nama_perusahaan_1', 100)->nullable();
            $table->string('bidang_usaha_1', 100)->nullable();
            $table->string('jabatan_1', 100)->nullable();
            $table->string('status_pekerjaan_1', 50)->nullable();
            $table->date('tanggal_mulai_kerja_1')->nullable();
            $table->unsignedBigInteger('gaji_pokok_1')->nullable();
            $table->string('cycle_gaji_pokok_1', 20)->nullable();
            $table->unsignedBigInteger('gaji_tambahan_1')->nullable();
            $table->text('daftar_cicilan_1')->nullable();

            $table->string('nama_usaha_1', 100)->nullable();
            $table->string('bidang_wirausaha_1', 100)->nullable();
            $table->smallInteger('lama_usaha_1')->unsigned()->nullable();
            $table->string('legalitas_1', 50)->nullable();
            $table->unsignedBigInteger('pendapatan_kotor_1')->nullable();
            $table->unsignedBigInteger('pendapatan_bersih_1')->nullable();
            $table->unsignedBigInteger('pendapatan_tambahan_1')->nullable();
            $table->text('daftar_cicilan_wirausaha_1')->nullable();

            $table->string('nama_perusahaan_2', 100)->nullable();
            $table->string('bidang_usaha_2', 100)->nullable();
            $table->string('jabatan_2', 100)->nullable();
            $table->string('status_pekerjaan_2', 50)->nullable();
            $table->date('tanggal_mulai_kerja_2')->nullable();
            $table->unsignedBigInteger('gaji_pokok_2')->nullable();
            $table->string('cycle_gaji_pokok_2', 20)->nullable();
            $table->unsignedBigInteger('gaji_tambahan_2')->nullable();
            $table->text('daftar_cicilan_2')->nullable();

            $table->string('nama_usaha_2', 100)->nullable();
            $table->string('bidang_wirausaha_2', 100)->nullable();
            $table->smallInteger('lama_usaha_2')->unsigned()->nullable();
            $table->string('legalitas_2', 50)->nullable();
            $table->unsignedBigInteger('pendapatan_kotor_2')->nullable();
            $table->unsignedBigInteger('pendapatan_bersih_2')->nullable();
            $table->unsignedBigInteger('pendapatan_tambahan_2')->nullable();
            $table->text('daftar_cicilan_wirausaha_2')->nullable();

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
