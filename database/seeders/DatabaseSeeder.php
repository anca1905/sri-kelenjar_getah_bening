<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan PENTING: rules harus di-seed SETELAH penyakit & gejala
        // karena rules memiliki FK ke keduanya
        $this->call([
            AdminSeeder::class,
            PenyakitSeeder::class,
            GejalaSeeder::class,
            RuleSeeder::class,
        ]);
    }
}