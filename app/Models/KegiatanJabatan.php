<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanJabatan extends Model
{
    use HasFactory;
    protected $fillable= [
        'kegiatan_id',
        'm_kegiatan_jabatan_id',
    ];

    public function mKegiatanJabatan()
    {
        return $this->belongsTo('App\Models\MKegiatanJabatan');
    }
    
    public function kegiatanBayarJabatan()
    {
        return $this->hasMany('App\Models\KegiatanBayarJabatan');
    }

    public function kegiatanPeserta()
    {
        return $this->hasMany('App\Models\KegiatanPeserta');
    }


}