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
        Schema::create('rap_rab_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rap_rab_id')->nullable()->constrained('rap_rab')->onDelete('cascade');
            $table->string('no_item')->nullable();
            $table->string('nama_item')->nullable();
            $table->string('satuan')->nullable();
            $table->string('rap_qty')->nullable();
            $table->string('persen_naik')->nullable();
            $table->string('rab_qty')->nullable();
            $table->string('harga_item')->nullable();
            $table->string('total_rap_item')->nullable();
            $table->string('total_rab_item')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rap_rab_items');
    }
};
