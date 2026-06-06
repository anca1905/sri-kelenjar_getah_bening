<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rule extends Model
{
    use HasFactory;

    protected $table = 'rules';
    protected $fillable = ['penyakit_id', 'gejala_id', 'mb', 'md'];

    // cf_pakar is a computed column, not fillable

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }

    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }

    // Virtual accessor for CF
    public function getCfPakarAttribute()
    {
        return round($this->mb - $this->md, 2);
    }
}