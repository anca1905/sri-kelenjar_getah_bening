<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RuleSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('rules')->truncate();

        // Aturan lama dihapus karena daftar gejala diubah.
        // User akan menambahkan aturan melalui sistem Admin.
    }
}
