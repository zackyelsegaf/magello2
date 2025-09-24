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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nik_pegawai')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->string('tempat_lahir_pegawai')->nullable();
            $table->string('tanggal_lahir_pegawai')->nullable();
            $table->foreignId('jenis_kelamin_pegawai_id')->nullable()->constrained('gender')->onDelete('cascade');
            $table->foreignId('agama_pegawai_id')->nullable()->constrained('religion')->onDelete('cascade');
            $table->foreignId('status_pernikahan_pegawai_id')->nullable()->constrained('status_pemasok')->onDelete('cascade');
            $table->foreignId('golongan_darah_id')->nullable()->constrained('golongan_darah')->onDelete('cascade');
            $table->string('email_pegawai')->nullable();
            $table->string('no_telp_pegawai')->nullable();
            $table->string('provinsi_code')->nullable();
            $table->string('kota_code')->nullable();
            $table->string('kecamatan_code')->nullable();
            $table->string('kelurahan_code')->nullable();
            $table->foreign('provinsi_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'districts')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'villages')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('rt_pegawai')->nullable();
            $table->string('rw_pegawai')->nullable();
            $table->string('alamat_pegawai')->nullable();
            $table->string('nama_bank_pegawai')->nullable();
            $table->string('nomor_rekening_pegawai')->nullable();
            $table->string('atas_nama_pegawai')->nullable();
            $table->foreignId('jenis_identitas_pegawai_id')->nullable()->constrained('kartu_identitas')->onDelete('cascade');
            $table->string('nomor_identitas_pegawai')->nullable();
            $table->string('nama_ayah_pegawai')->nullable();
            $table->string('nama_ibu_pegawai')->nullable();
            $table->string('nama_kontak_darurat_pegawai')->nullable();
            $table->string('no_telp_darurat_pegawai')->nullable();
            $table->string('hubungan_pegawai')->nullable();
            $table->foreignId('status_pekerjaan_pegawai_id')->nullable()->constrained('status_pekerja')->onDelete('cascade');
            $table->string('foto_pegawai')->nullable();
            $table->string('tanggal_masuk_pegawai')->nullable();
            $table->string('tanggal_keluar_pegawai')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
