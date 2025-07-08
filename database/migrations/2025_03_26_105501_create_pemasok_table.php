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
        Schema::create('pemasok', function (Blueprint $table) {
            $table->id();
            $table->string('pemasok_id')->unique(); // No TB-xxx
            $table->string('nama')->nullable();
            $table->foreignId('status_pemasok_id')->nullable()->constrained('status_pemasok')->nullOnDelete(); // ex: C.O.D, Net 30
            $table->boolean('dihentikan')->default(false);

            // Info alamat
            $table->string('alamat_1')->nullable();
            $table->string('alamat_2')->nullable();
            $table->string('alamatpajak_1')->nullable();
            $table->string('alamatpajak_2')->nullable();
            $table->string('kode_pos')->nullable();

            $table->char('provinsi_code', 2)->nullable()->index();
            $table->char('kota_code', 4)->nullable()->index();

            $table->foreign('provinsi_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('kota_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')
                ->onDelete('set null');

            // Kontak
            $table->string('kontak')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_fax')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            // Pajak & keuangan
            $table->string('npwp')->nullable();
            $table->foreignId('pajak_1_id')->nullable()->constrained('pajak')->nullOnDelete();
            $table->foreignId('pajak_2_id')->nullable()->constrained('pajak')->nullOnDelete();
            $table->string('no_pkp')->nullable();

            // Syarat & mata uang
            $table->foreignId('syarat_id')->nullable()->constrained('syarat')->nullOnDelete(); // ex: C.O.D, Net 30
            $table->foreignId('mata_uang_id')->nullable()->constrained('mata_uang')->nullOnDelete(); // IDR, USD, dsb

            // Saldo awal
            $table->decimal('saldo_awal', 20, 2)->default(0);
            $table->date('tanggal_saldo_awal')->nullable();

            // Deskripsi / memo
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasok');
    }
};
