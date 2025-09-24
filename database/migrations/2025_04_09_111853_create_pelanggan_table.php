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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('pelanggan_id')->unique();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->foreignId('tipe_pelanggan_id')->nullable()->constrained('tipe_pelanggan')->nullOnDelete();
            $table->foreignId('penjual_id')->nullable()->constrained('penjual')->nullOnDelete();
            // $table->foreignId('proyek_id')->nullable()->constrained('proyek')->nullOnDelete();
            $table->nullableMorphs('proyek');
            $table->string('npwp')->nullable();
            $table->string('nppkp')->nullable();
            $table->foreignId('pajak_1_id')->nullable()->constrained('pajak')->nullOnDelete();
            $table->foreignId('pajak_2_id')->nullable()->constrained('pajak')->nullOnDelete();
            $table->foreignId('syarat_id')->nullable()->constrained('syarat')->nullOnDelete();
            $table->string('level_harga')->nullable();
            $table->string('diskon_penjualan_pelanggan')->nullable();
            $table->foreignId('mata_uang_id')->nullable()->constrained('mata_uang')->nullOnDelete();
            $table->string('saldo_awal')->nullable();
            $table->date('tanggal_pelanggan')->nullable();
            $table->string('alamat_1')->nullable();
            $table->string('alamat_2')->nullable();
            $table->string('alamatpajak_1')->nullable();
            $table->string('alamatpajak_2')->nullable();
            $table->char('provinsi_code', 2)->nullable()->index();
            $table->char('kota_code', 4)->nullable()->index();
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
            $table->string('kode_pos')->nullable();
            $table->string('kontak')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_fax')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->boolean('dihentikan')->default(false);
            $table->string('status_pengajuan')->nullable();
            $table->boolean('is_booking')->default(false);
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->foreignId('status_id')->nullable()->constrained('status_pemasok')->nullOnDelete();
            $table->date('tanggal_lahir')->nullable();
            $table->date('tanggal_saldo_awal')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->foreignId('religion_id')->nullable()->constrained('religion')->nullOnDelete();
            $table->foreignId('gender_id')->nullable()->constrained('gender')->nullOnDelete();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('batas_maks_hutang')->nullable();
            $table->string('batas_umur_hutang')->nullable();
            $table->string('deskripsi')->nullable();
            $table->text('memo')->nullable();
            $table->string('fileupload_1')->nullable();
            $table->string('fileupload_2')->nullable();
            $table->string('fileupload_3')->nullable();
            $table->string('fileupload_4')->nullable();
            $table->string('fileupload_5')->nullable();
            $table->string('fileupload_6')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
