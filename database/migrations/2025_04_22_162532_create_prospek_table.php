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
        Schema::create('prospek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cluster_id')->nullable()->constrained('cluster')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('ditugaskan_ke')->nullable();
            $table->string('sumber_prospek')->nullable();
            $table->string('warm_meter')->nullable();
            $table->string('tags')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospek');
    }
};
