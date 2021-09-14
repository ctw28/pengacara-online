<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPembayaran extends Model
{
    use HasFactory;
    protected $fillable= [
        'kegiatan_id',
        'kegiatan_peserta_id',
        'kegiatan_pembayaran_tanggal',
        'kegiatan_pembayaran_tanggal_lunas',
    ];

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Kegiatan');
    }

    public function kegiatanPeserta()
    {
        return $this->belongsTo('App\Models\KegiatanPeserta');
    }
    public function kegiatanPembayaranSesi()
    {
        return $this->hasMany('App\Models\KegiatanPembayaranSesi','pembayaran_id');
    }
}