<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPeserta extends Model
{
    use HasFactory;

    protected $fillable= [
        'idpeg',
        'kegiatan_jabatan_id',
        'nama',
        'nip',
        'golongan',
        'pajak',
        'is_iain',
    ];

    public function kegiatanJabatan()
    {
        return $this->belongsTo('App\Models\KegiatanJabatan');
    }
}