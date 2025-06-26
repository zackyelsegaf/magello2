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
        Schema::create('pembiayaan_rincian_akuns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembiayaan_pesanan_id')->constrained()->onDelete('cascade');

            $table->string('no_akun');
            $table->date('tanggal');
            $table->string('nama_akun');
            $table->text('catatan')->nullable();
            $table->decimal('nilai', 15, 2);

            // Foreign keys
            $table->foreignId('proyek_id')->nullable()->constrained('proyek')->onDelete('set null');
            $table->foreignId('departemen_id')->nullable()->constrained('departemen')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembiayaan_rincian_akuns');
    }
};
