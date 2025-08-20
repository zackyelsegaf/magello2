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
        Schema::create('data_lahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tanah');
            $table->foreignId('cluster_id')->nullable()->constrained('cluster')->nullOnDelete();
            $table->date('tanggal_perolehan')->nullable();
            $table->foreignId('pemasok_id')->nullable()->constrained('pemasok')->nullOnDelete(); // relasi ke pemasok
            $table->string('no_hp_tuan_tanah')->nullable();
            $table->double('luas_area')->nullable();
            $table->decimal('harga_per_m2', 15, 2)->nullable();
            $table->text('note')->nullable();
            $table->boolean('dicatat_sebagai')->nullable(); // true = pembelian baru, false = sudah dibeli
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_lahans');
    }
};
