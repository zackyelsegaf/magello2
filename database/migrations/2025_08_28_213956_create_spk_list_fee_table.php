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
        Schema::create('spk_list_fee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spk_id')->constrained('surat_perintah_kerja')->onDelete('cascade');
            $table->string('nama_kapling')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('upah')->nullable();
            $table->string('retensi')->nullable();
            $table->string('nominal_perjanjian')->nullable();
            $table->string('nama_termin')->nullable();
            $table->string('persen_pekerjaan')->nullable();
            $table->string('persen_pembayaran')->nullable();
            $table->string('nilai_termin')->nullable();
            $table->string('total_persentase_pembayaran')->nullable();
            $table->string('total_nilai_termin')->nullable();
            $table->string('grand_total_persentase_pembayaran')->nullable();
            $table->string('grand_total_nilai_termin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spk_list_fee');
    }
};
