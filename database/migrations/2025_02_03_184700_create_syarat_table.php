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
        Schema::create('syarat', function (Blueprint $table) {
            $table->id();

            $table->string('nama'); // Contoh: Net 30, C.O.D
            $table->integer('batas_hutang')->default(0); // dalam hari
            $table->boolean('cash_on_delivery')->default(false);

            // Diskon pembayaran lebih awal
            $table->decimal('persentase_diskon', 5, 2)->default(0.00); // ex: 2.50 %
            $table->integer('periode_diskon')->default(0); // dalam hari

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat');
    }
};
