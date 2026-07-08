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
        Schema::table('kandidat', function (Blueprint $table) {
            $table->string('status_ujian_pribadi')->default('pending'); // pending, active, finished
            $table->timestamp('resume_time_pribadi')->nullable();
            $table->integer('sisa_waktu_detik')->nullable(); // null kalau belum mulai
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kandidat', function (Blueprint $table) {
            $table->dropColumn(['status_ujian_pribadi', 'resume_time_pribadi', 'sisa_waktu_detik']);
        });
    }
};
