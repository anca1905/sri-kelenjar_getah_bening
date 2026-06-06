<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sesi', 30)->unique(); // KGB-YYYYMMDD-XXX
            $table->string('nama_pasien')->nullable();
            $table->string('diagnosis_utama')->nullable();
            $table->decimal('nilai_cf', 5, 4)->nullable(); // 0.0000 – 1.0000
            $table->json('detail_hasil')->nullable();  // Array semua penyakit + CF
            $table->json('detail_gejala')->nullable(); // Input gejala user
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
