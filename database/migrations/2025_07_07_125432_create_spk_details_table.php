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
        Schema::create('spk_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spk_id')->constrained('spks')->onDelete('cascade');
            $table->foreignId('unit_property_id')->constrained('unit_properties')->onDelete('cascade');

            $table->string('pekerjaan')->nullable();
            $table->decimal('nilai_fee', 15, 2)->default(0);
            $table->unsignedTinyInteger('persentase_pekerjaan')->default(100);
            $table->unsignedTinyInteger('retensi')->default(0); // retensi (%)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spk_details');
    }
};
