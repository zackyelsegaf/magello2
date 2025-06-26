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
        Schema::create('harga_juals', function (Blueprint $table) {
            $table->id();

            $table->string('no_penyesuaian')->unique();
            $table->date('tgl_efektif')->nullable();
            $table->date('tgl_penyesuaian')->nullable();
            $table->text('deskripsi')->nullable();

            $table->foreignId('jenis_harga_id')->constrained('jenis_harga')->onDelete('restrict');
            $table->foreignId('metode_penyesuaian_id')->constrained('metode_penyesuaian')->onDelete('restrict');
            $table->foreignId('nilai_pembulatan_id')->nullable()->constrained('nilai_pembulatan')->onDelete('set null');
            $table->foreignId('sumber_nilai_asal_id')->constrained('sumber_nilai_asal')->onDelete('restrict');
            $table->foreignId('unit_id')->nullable()->constrained('unit_barang')->onDelete('set null');

            $table->decimal('nilai_masukan', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_juals');
    }
};
