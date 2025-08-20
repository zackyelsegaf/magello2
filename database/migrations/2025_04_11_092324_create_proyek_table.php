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
        Schema::create('proyek', function (Blueprint $table) {
            $table->id();
            $table->string('proyek_id')->unique(); // disarankan unik
            $table->string('nama_proyek')->nullable();
            $table->string('nama_kontak')->nullable();

            $table->date('tanggal_from')->nullable();
            $table->date('tanggal_to')->nullable();

            $table->decimal('persentase_komplet', 5, 2)->default(0); // ex: 85.50
            $table->boolean('persentase_komplet_check')->default(false);

            $table->text('deskripsi')->nullable();
            $table->boolean('dihentikan')->default(false);

            $table->decimal('total_pendapatan', 20, 2)->default(0);
            $table->decimal('total_pendapatan_from', 20, 2)->default(0);

            $table->decimal('total_biaya', 20, 2)->default(0);
            $table->decimal('total_biaya_from', 20, 2)->default(0);

            $table->decimal('total_beban', 20, 2)->default(0);
            $table->decimal('total_beban_from', 20, 2)->default(0);

            $table->decimal('laba_rugi', 20, 2)->default(0);
            $table->decimal('laba_rugi_from', 20, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek');
    }
};
