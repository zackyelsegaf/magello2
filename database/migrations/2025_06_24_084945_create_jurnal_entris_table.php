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
        Schema::create('jurnal_entris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurnal_id')->constrained('jurnals')->onDelete('cascade');
            $table->foreignId('akun_id')->constrained('akun')->onDelete('restrict');
            $table->foreignId('department_id')->nullable()->constrained('departemen')->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained('proyek')->onDelete('set null');
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->onDelete('set null');
            $table->decimal('debit', 20, 2)->default(0);
            $table->decimal('credit', 20, 2)->default(0);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal_entris');
    }
};
