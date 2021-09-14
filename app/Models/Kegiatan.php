<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pengaturan_fakultas_id',
        'kegiatan_nama',
        'kegiatan_tanggal',
        'kegiatan_sub_kegiatan',
        'kegiatan_akun',
        'kegiatan_sk',
        'kegiatan_sk_tanggal',
    ];

    public function pengaturanFakultasId()
    {
        return $this->belongsTo('App\Models\PengaturanFakultas');
    }
    public function kegiatanPembayaran()
    {
        return $this->hasMany('App\Models\KegiatanPembayaran');
    }
}