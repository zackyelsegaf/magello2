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
        Schema::create('timeline_booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking_kavling')->onDelete('cascade');
            $table->boolean('is_current')->default(false)->index();
            $table->unsignedTinyInteger('status_code')->index()->comment();
            $table->morphs('statusable');
            $table->text('notes')->nullable();
            $table->timestamp('changed_at')->useCurrent();
            $table->foreignId('changed_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->unique(['booking_id', 'status_code']);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeline_booking');
    }
};
