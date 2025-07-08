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
        Schema::create('harga_jual_item_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('harga_jual_item_id')->constrained('harga_jual_items')->onDelete('cascade');
            $table->foreignId('jenis_harga_id')->constrained('jenis_hargas')->onDelete('restrict');

            $table->decimal('nilai', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_jual_item_details');
    }
};
