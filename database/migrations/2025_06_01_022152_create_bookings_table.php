<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('event_id')->constrained()->onDelete('cascade');
        $table->string('nama');
        $table->string('email');
        $table->string('nomor_hp');
        $table->string('bukti_pembayaran')->nullable();
        $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
        $table->timestamps();

        $table->unique(['user_id', 'event_id', 'email'], 'user_event_email_unique');
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
