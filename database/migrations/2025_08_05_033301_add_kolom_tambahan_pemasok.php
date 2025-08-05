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
        Schema::table('pemasok', function (Blueprint $table) {
            $table->string('npwp')->nullable();
            $table->string('pajak_1')->nullable();
            $table->string('pajak_2')->nullable();
            $table->string('syarat')->nullable();
            $table->string('mata_uang')->nullable();
            $table->decimal('saldo_awal', 30, 10)->default(0);
            $table->date('tanggal')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('no_pkp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemasok', function (Blueprint $table) {
            $table->dropColumn([
                'npwp',
                'pajak_1',
                'pajak_2',
                'syarat',
                'mata_uang',
                'saldo_awal',
                'tanggal',
                'deskripsi',
                'no_pkp',
            ]);
        });
    }
};
