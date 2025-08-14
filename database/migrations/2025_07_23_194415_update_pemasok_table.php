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
        Schema::table('pemasok', function(Blueprint $table){
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('negara')->nullable();
            $table->text('memo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemasok', function(Blueprint $table){
            $table->dropColumn('provinsi');
            $table->dropColumn('kota');
            $table->dropColumn('negara');
            $table->dropColumn('memo');
        });
    }
};
