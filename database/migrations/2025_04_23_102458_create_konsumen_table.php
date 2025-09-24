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
            $table->string('nama_konsumen')->nullable();
            $table->string('nik_konsumen')->nullable();
            $table->string('no_hp')->nullable();
            $table->foreignId('status_pengajuan_id')->nullable()->constrained('status_pengajuan')->onDelete('cascade');
            $table->foreignId('cluster_id')->nullable()->constrained('cluster')->onDelete('cascade');
            $table->foreignId('jenis_kelamin_id')->nullable()->constrained('gender')->onDelete('cascade');
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
            $table->foreignId('pekerjaan_id')->nullable()->constrained('tipe_pelanggan')->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->string('tanggal_booking')->nullable();
            $table->string('booking_fee')->nullable();
            $table->string('marketing')->nullable();
            $table->string('nik_pasangan')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->string('no_hp_pasangan')->nullable();
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
