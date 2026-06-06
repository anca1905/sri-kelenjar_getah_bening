<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom kategori dari ENUM menjadi string biasa
        // agar bisa menampung nama penyakit sebagai kategori
        DB::statement("ALTER TABLE gejalas MODIFY COLUMN kategori VARCHAR(100) NOT NULL DEFAULT 'Umum'");
    }

    public function down(): void
    {
        // Kembalikan ke ENUM semula
        DB::statement("ALTER TABLE gejalas MODIFY COLUMN kategori ENUM('Gejala Umum','Gejala Tambahan') NOT NULL DEFAULT 'Gejala Umum'");
    }
};
