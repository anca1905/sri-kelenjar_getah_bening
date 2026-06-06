<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayats';
    protected $fillable = [
        'kode_sesi',
        'nama_pasien',
        'umur',
        'jenis_kelamin',
        'diagnosis_utama',
        'nilai_cf',
        'detail_hasil',
        'detail_gejala',
    ];

    protected $casts = [
        'detail_hasil'  => 'array',
        'detail_gejala' => 'array',
        'nilai_cf'      => 'float',
    ];
}