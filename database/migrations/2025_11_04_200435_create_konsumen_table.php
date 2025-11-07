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
        Schema::create('konsumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_pengajuan_id')->nullable()->constrained('status_pengajuan')->onDelete('cascade');
            $table->foreignId('cluster_id')->nullable()->constrained('cluster')->onDelete('cascade');
            $table->foreignId('jenis_kelamin_id')->nullable()->constrained('gender')->onDelete('cascade');
            $table->foreignId('pekerjaan_1_id')->nullable()->constrained('tipe_pelanggan')->onDelete('cascade');
            // $table->foreignId('booking_id')->nullable()->constrained('booking_kavling')->nullOnDelete();
            $table->foreignId('status_pernikahan_id')->nullable()->constrained('status_pemasok')->onDelete('cascade');
            $table->foreignId('pajak_1_id')->nullable()->constrained('pajak')->onDelete('cascade');
            $table->foreignId('pajak_2_id')->nullable()->constrained('pajak')->onDelete('cascade');
            $table->foreignId('syarat_id')->nullable()->constrained('syarat')->onDelete('cascade');
            $table->foreignId('level_harga_id')->nullable()->constrained('level_harga')->onDelete('cascade');
            $table->foreignId('religion_id')->nullable()->constrained('religion')->onDelete('cascade');
            $table->string('nama_1')->nullable();
            $table->string('nik_1')->nullable();
            $table->string('no_hp_1')->nullable();
            $table->string('tempat_lahir_1')->nullable();
            $table->string('tanggal_lahir_1')->nullable();
            $table->string('alamat_pajak_1')->nullable();
            $table->string('alamat_pajak_2')->nullable();
            $table->string('npwp_1')->nullable();
            $table->string('nppkp_konsumen')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('batas_maks_hutang')->nullable();
            $table->string('batas_umur_hutang')->nullable();
            $table->string('diskon_penjualan')->nullable();
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
            $table->string('alamat_konsumen')->nullable();
            $table->string('provinsi_code_1')->nullable();
            $table->string('kota_code_1')->nullable();
            $table->string('kecamatan_code_1')->nullable();
            $table->string('kelurahan_code_1')->nullable();
            $table->foreign('provinsi_code_1')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kota_code_1')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kecamatan_code_1')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'districts')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('kelurahan_code_1')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'villages')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('alamat_1')->nullable();
            $table->string('tanggal_booking')->nullable();
            $table->string('booking_fee')->nullable();
            $table->string('marketing')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsumen');
    }
};
