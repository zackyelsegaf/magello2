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
        Schema::create('rap_rab', function (Blueprint $table) {
            $table->id();
            $table->string('judul_rap')->nullable();
            $table->string('cluster')->nullable();
            $table->string('tanggal_pencatatan')->nullable();
            $table->string('persen_kenaikan_qty')->nullable();
            $table->string('tipe_model')->nullable();
            $table->string('total_rap')->nullable();
            $table->string('total_rab')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rap_rab');
    }
};
