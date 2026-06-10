<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GejalaSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('gejalas')->truncate();

        DB::table('gejalas')->insert([
            ['kode' => 'G001', 'nama' => 'Demam naik turun', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G002', 'nama' => 'Benjolan di leher', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G003', 'nama' => 'Teraba keras', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G004', 'nama' => 'Nyeri saat ditekan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G005', 'nama' => 'Batuk', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G006', 'nama' => 'Mual', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G007', 'nama' => 'Muntah', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G008', 'nama' => 'Benjolan tampak merah', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G009', 'nama' => 'Pusing', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G010', 'nama' => 'Nyeri menelan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G011', 'nama' => 'Badan lemas', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G012', 'nama' => 'Luka nanah', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G013', 'nama' => 'Nafsu makan menurun', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G014', 'nama' => 'Flu', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G015', 'nama' => 'Mulut tidak bisa dibuka', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G016', 'nama' => 'Nyeri pada gigi', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G017', 'nama' => 'Batuk berdahak', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G018', 'nama' => 'Penurunan berat badan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G019', 'nama' => 'Sulit tidur', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G020', 'nama' => 'Menggigil', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G021', 'nama' => 'Benjolan terus membesar', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G022', 'nama' => 'Keringat berlebihan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G023', 'nama' => 'Nyeri dada', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G024', 'nama' => 'Sesak nafas', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G025', 'nama' => 'Gemetar seluruh tubuh', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G026', 'nama' => 'Penurunan kesadaran tiba-tiba', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G027', 'nama' => 'Demam berulang', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G028', 'nama' => 'Nyeri pada leher', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G029', 'nama' => 'Hidung tersumbat', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G030', 'nama' => 'Lemas', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G031', 'nama' => 'Nyeri terus menerus', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G032', 'nama' => 'Lemas seluruh badan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G033', 'nama' => 'Lendir berlebihan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G034', 'nama' => 'Jantung berdebar-debar', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G035', 'nama' => 'Susah tidur', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G036', 'nama' => 'Tampak benjolan di leher', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
