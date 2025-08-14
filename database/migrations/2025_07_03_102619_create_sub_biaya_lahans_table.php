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
        Schema::create('sub_biaya_lahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_lahan_id')->constrained()->onDelete('cascade');
            $table->foreignId('master_biaya_lahan_id')->constrained()->onDelete('cascade');

            $table->date('tanggal')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('qty')->default(0);
            $table->decimal('harga', 15, 2)->default(0);
            $table->decimal('total', 20, 2)->default(0);
            $table->text('catatan')->nullable();

            // TIPE PEMBAYARAN nullable unsignedTinyInteger
            $table->unsignedTinyInteger('tipe_pembayaran')->nullable(); // ex: 'Tunai', 'Kredit'
            $table->foreignId('akun_id')->nullable()->constrained('akun')->nullOnDelete(); // hanya jika tunai
            $table->boolean('is_buat_jadwal')->nullable(); // hanya jika kredit

            // CHECKBOX
            $table->boolean('posting_jurnal')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_biaya_lahans');
    }
};
