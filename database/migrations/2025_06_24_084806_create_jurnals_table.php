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
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->string('jurnal_no')->unique();
            $table->date('jurnal_date');
            $table->text('description')->nullable();
            $table->string('source')->nullable();
            $table->string('user')->nullable();
            $table->string('branch')->nullable();
            $table->string('approval_no')->nullable();
            $table->text('inspection_note')->nullable();
            $table->text('follow_up')->nullable();
            $table->boolean('approved')->default(false);
            $table->boolean('urgent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
