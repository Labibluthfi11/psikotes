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
        Schema::create('hasil_tes', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('posisi');
            $table->date('tanggal');
            
            // Skor tipe integer
            $table->integer('skor_o');
            $table->integer('skor_c');
            $table->integer('skor_e');
            $table->integer('skor_a');
            $table->integer('skor_n');
            $table->integer('skor_logika');
            
            // Kategori tipe string
            $table->string('kat_o');
            $table->string('kat_c');
            $table->string('kat_e');
            $table->string('kat_a');
            $table->string('kat_n');
            $table->string('kat_logika');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_tes');
    }
};
