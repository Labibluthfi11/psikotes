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
        Schema::table('ujian_settings', function (Blueprint $table) {
            $table->timestamp('waktu_berakhir')->nullable();
            $table->integer('sisa_waktu_paused')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ujian_settings', function (Blueprint $table) {
            $table->dropColumn(['waktu_berakhir', 'sisa_waktu_paused']);
        });
    }
};
