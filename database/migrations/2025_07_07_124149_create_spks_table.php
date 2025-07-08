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
        Schema::create('spks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->unique();
            $table->string('judul')->nullable();
            $table->unsignedTinyInteger('tipe'); // 1 = internal, 2 = subcon
            $table->date('tanggal_spk');
            $table->string('lampiran')->nullable();

            $table->foreignId('pekerja_id')->constrained('pekerjas')->onDelete('restrict');
            $table->date('tanggal_mulai')->nullable();
            $table->integer('lama_pengerjaan')->nullable();
            $table->foreignId('siklus_pembayaran_id')->nullable()->constrained('siklus_pembayaran')->nullOnDelete();

            $table->unsignedTinyInteger('tipe_pembayaran_subcon')->nullable(); // 1 = termin, 2 = full
            $table->foreignId('spp_id')->nullable()->constrained('surat_perintah_pembangunans')->nullOnDelete();
            $table->decimal('nilai_perjanjian', 15, 2)->nullable();

            $table->text('syarat_ketentuan')->nullable();

            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->boolean('is_approved')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete(); // asumsi pakai tabel users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spks');
    }
};
