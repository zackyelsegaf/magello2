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
        Schema::create('sub_biaya_lahan_kredits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_biaya_lahan_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_bayar');
            $table->decimal('nominal', 20, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_biaya_lahan_kredits');
    }
};
