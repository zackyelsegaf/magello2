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

            // Info dasar
            $table->string('kode_pelanggan')->unique();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->foreignId('tipe_pelanggan_id')->nullable()->constrained('tipe_pelanggan')->nullOnDelete(); // relasi ke tipe_pelanggan

            // Penjual dan proyek
            $table->foreignId('penjual_id')->nullable()->constrained('penjual')->nullOnDelete();
            // $table->foreignId('proyek_id')->nullable()->constrained('proyek')->nullOnDelete(); // nama cluster
            $table->nullableMorphs('proyek');

            // Pajak dan syarat
            $table->string('npwp')->nullable();
            $table->string('nppkp')->nullable();
            $table->foreignId('pajak_1_id')->nullable()->constrained('pajak')->nullOnDelete();
            $table->foreignId('pajak_2_id')->nullable()->constrained('pajak')->nullOnDelete();
            $table->foreignId('syarat_id')->nullable()->constrained('syarat')->nullOnDelete();

            // Level harga & diskon
            $table->integer('level_harga')->default(0);
            $table->decimal('diskon_penjualan', 5, 2)->nullable();

            // Mata uang dan saldo
            $table->foreignId('mata_uang_id')->nullable()->constrained('mata_uang')->nullOnDelete();
            $table->decimal('saldo_awal', 15, 2)->default(0);
            $table->date('tanggal_saldo_awal')->nullable();

            // Alamat
            $table->string('alamat_1')->nullable();
            $table->string('alamat_2')->nullable();
            $table->string('alamatpajak_1')->nullable();
            $table->string('alamatpajak_2')->nullable();

            $table->char('provinsi_code', 2)->nullable()->index();
            $table->char('kota_code', 4)->nullable()->index();

            $table->foreign('provinsi_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('kota_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('kode_pos')->nullable();

            // Kontak
            $table->string('kontak')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_fax')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            // Lainnya
            $table->boolean('dihentikan')->default(false);
            $table->string('status_pengajuan')->nullable(); // dari dropdown

            // Booking Support
            $table->boolean('is_booking')->default(false);
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();

            // Info tambahan
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();

            // ✅ Ganti string → foreignId
            $table->foreignId('religion_id')->nullable()->constrained('religion')->nullOnDelete();
            $table->foreignId('gender_id')->nullable()->constrained('gender')->nullOnDelete();

            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->text('memo')->nullable();

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
