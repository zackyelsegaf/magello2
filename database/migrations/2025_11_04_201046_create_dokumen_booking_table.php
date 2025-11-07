<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokumen_booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking_kavling')->onDelete('cascade');
            $table->foreignId('jenis_dokumen_persyaratan_id')->constrained('jenis_dokumen_persyaratan')->onDelete('cascade');
            $table->boolean('is_submitted')->default(false)->index();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
            $table->unique(['booking_id', 'jenis_dokumen_persyaratan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_documents');
    }
};
