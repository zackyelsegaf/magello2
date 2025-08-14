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
        Schema::create('anggaran_akuns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_id')->constrained('akun')->onDelete('cascade');
            $table->decimal('nilai_saldo_awal', 20, 2)->default(0);
            for ($i = 1; $i <= 12; $i++) {
                $table->decimal("periode_$i", 20, 2)->default(0);
            }
            $table->boolean('tampilkan_peringatan')->default(false);
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_akuns');
    }
};
