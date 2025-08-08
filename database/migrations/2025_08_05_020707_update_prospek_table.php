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
        Schema::table('prospek', function(Blueprint $table){
            $table->string('cluster')->nullable();
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('ditugaskan_ke')->nullable();
            $table->string('sumber_prospek')->nullable();
            $table->string('warm_meter')->nullable();
            $table->string('tags')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prospek', function(Blueprint $table){
            $table->dropColumn('cluster');
            $table->dropColumn('nama');
            $table->dropColumn('email');
            $table->dropColumn('no_hp');
            $table->dropColumn('ditugaskan_ke');
            $table->dropColumn('sumber_prospek');
            $table->dropColumn('warm_meter');
            $table->dropColumn('tags');
            $table->dropColumn('status');
        });
    }
};
