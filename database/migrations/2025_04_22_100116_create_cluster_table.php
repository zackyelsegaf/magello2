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
        Schema::create('cluster', function (Blueprint $table) {
            $table->id();
            $table->string('nama_cluster')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('luas_tanah')->nullable();
            $table->string('total_unit')->nullable();
            // ✅ Relasi ke Laravolt
            $table->char('provinsi_code', 2)->nullable()->index();
            $table->char('kota_code', 4)->nullable()->index();

            // ❌ Tidak pakai Laravolt, simpan biasa
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();

            $table->string('alamat_cluster')->nullable();

            // Foreign Key ke Laravolt
            $table->foreign('provinsi_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('kota_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cluster');
    }
};
