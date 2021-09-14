<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTahunAnggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_anggaran',
        'tahun_anggaran_sebutan'
    ];

    public function tahunAnggaranDipa()
    {
        return $this->hasOne('App\Models\TahunAnggaranDipa','tahun_anggaran_id');
    }

}