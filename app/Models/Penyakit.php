<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penyakit extends Model
{
    use HasFactory;

    protected $table = 'penyakits';
    protected $fillable = ['nama', 'deskripsi', 'solusi'];

    public function rules()
    {
        return $this->hasMany(Rule::class, 'penyakit_id');
    }
}