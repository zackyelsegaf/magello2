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
        Schema::table('barang', function (Blueprint $table) {
            $table->string('satuan')->nullable();
            $table->integer('rasio')->nullable()->default(1);
            $table->integer('level_harga_1')->nullable()->default(0);
            $table->integer('level_harga_2')->nullable()->default(0);
            $table->integer('level_harga_3')->nullable()->default(0);
            $table->integer('level_harga_4')->nullable()->default(0);
            $table->integer('level_harga_5')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColum('satuan');
            $table->dropColum('rasio');
            $table->dropColum('level_harga_1');
            $table->dropColum('level_harga_2');
            $table->dropColum('level_harga_3');
            $table->dropColum('level_harga_4');
            $table->dropColum('level_harga_5');
        });
    }
};
