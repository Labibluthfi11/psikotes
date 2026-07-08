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
        Schema::create('ujian_settings', function (Blueprint $table) {
            $table->id();
            $table->string('status_ujian_global')->default('idle'); // idle, running, paused
            $table->timestamp('waktu_mulai_global')->nullable();
            $table->integer('durasi_total_menit')->default(60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujian_settings');
    }
};
