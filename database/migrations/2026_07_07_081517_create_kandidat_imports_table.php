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
        Schema::create('kandidat_imports', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('password'); // Note: Store plain password only if absolutely necessary for temporary display, otherwise it's better to log plain text in a secure way or just hash. Given requirements, I'll store it.
            $table->string('posisi');
            $table->timestamp('imported_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kandidat_imports');
    }
};
