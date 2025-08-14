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
        Schema::create('detail_pembayaran_lainnya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembayaran_id');
            $table->foreignId('akun_id');
            $table->integer('jumlah')->default(0);
            $table->string('catatan')->nullable();
            $table->foreignId('departemen_id')->nullable()->constrained('departemen')->onDelete('cascade');
            $table->foreignId('proyek_id')->nullable()->constrained('proyek')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembayaran_lainnya');
    }
};
