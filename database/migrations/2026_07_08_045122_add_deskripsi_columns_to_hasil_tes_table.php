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
        Schema::table('hasil_tes', function (Blueprint $table) {
            $table->text('desk_o')->nullable();
            $table->text('desk_c')->nullable();
            $table->text('desk_e')->nullable();
            $table->text('desk_a')->nullable();
            $table->text('desk_n')->nullable();
            $table->json('jawaban_detail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_tes', function (Blueprint $table) {
            $table->dropColumn(['desk_o', 'desk_c', 'desk_e', 'desk_a', 'desk_n', 'jawaban_detail']);
        });
    }
};
