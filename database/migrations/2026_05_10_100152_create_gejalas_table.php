<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gejalas', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique(); // G001, G002, ...
            $table->string('nama');
            $table->enum('kategori', ['Gejala Umum', 'Gejala Tambahan'])->default('Gejala Umum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gejalas');
    }
};
