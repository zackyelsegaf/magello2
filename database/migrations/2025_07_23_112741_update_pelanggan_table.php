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
        Schema::table('pelanggan', function(Blueprint $table){
            $table->foreignId('status_id')->nullable()->constrained('status_pemasok')->onDelete('cascade');
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('negara')->nullable();
            $table->integer('matas_maks_hutang')->nullable()->default(0);
            $table->integer('matas_umur_hutang')->nullable()->default(0);
            $table->text('deskripsi')->nullable();
            $table->integer('level_harga')->nullable()->default(0)->change();
            $table->decimal('saldo_awal', 15, 2)->nullable()->default(0)->change();
            $table->boolean('is_booking')->nullable()->default(0)->change();
            // $table->dropColumn('status_pengajuan');
            // $table->dropColumn('is_booking');
            // $table->dropColumn('booking_id');
            // $table->dropColumn('tanggal_lahir');
            // $table->dropColumn('tempat_lahir');
            // $table->dropColumn('religion_id');
            // $table->dropColumn('gender_id');
            // $table->dropColumn('nama_ayah');
            // $table->dropColumn('nama_ibu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelanggan', function(Blueprint $table){
            $table->dropIndex('pelanggan_status_id_foreign');
            $table->dropColumn('status_id');
            $table->dropColumn('provinsi');
            $table->dropColumn('kota');
            $table->dropColumn('negara');
            $table->dropColumn('matas_maks_hutang');
            $table->dropColumn('matas_umur_hutang');
            $table->dropColumn('deskripsi');
            $table->integer('level_harga')->default(0)->change();
            $table->decimal('saldo_awal', 15, 2)->default(0)->change();
            $table->boolean('is_booking')->default(0)->change();
        });
    }
};
