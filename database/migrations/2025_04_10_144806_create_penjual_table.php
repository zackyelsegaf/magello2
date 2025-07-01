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
        Schema::create('penjual', function (Blueprint $table) {
            $table->id();
            // Identitas dasar
            $table->string('nama_depan_penjual')->nullable();
            $table->string('nama_belakang_penjual')->nullable();
            $table->string('jabatan')->nullable();
            $table->boolean('dihentikan')->default(false);

            // Kontak
            $table->string('no_kantor_1_penjual')->nullable();
            $table->string('no_kantor_2_penjual')->nullable();
            $table->string('no_ekstensi_1_penjual')->nullable();
            $table->string('no_ekstensi_2_penjual')->nullable();
            $table->string('no_hp_penjual')->nullable();
            $table->string('no_telp_penjual')->nullable();
            $table->string('no_fax_penjual')->nullable();
            $table->string('pager_penjual')->nullable();
            $table->string('email_penjual')->nullable();

            // Lain-lain
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjual');
    }
};
