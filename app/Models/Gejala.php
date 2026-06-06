<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gejala extends Model
{
    use HasFactory;

    protected $table = 'gejalas';
    protected $fillable = ['kode', 'nama', 'kategori'];

    public function rules()
    {
        return $this->hasMany(Rule::class, 'gejala_id');
    }
}