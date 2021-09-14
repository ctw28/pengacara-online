<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPembayaranSesi extends Model
{
    use HasFactory;
    protected $fillable= [
        'pembayaran_id',
        'kegiatan_bayar_jabatan_id',
    ];

    public function kegiatanPembayaran()
    {
        return $this->belongsTo('App\Models\KegiatanPembayaran');
    }
    public function kegiatanBayarJabatan()
    {
        return $this->belongsTo('App\Models\KegiatanBayarJabatan');
    }
    
    public function kegiatanPesertaBayar()
    {
        return $this->hasMany('App\Models\KegiatanPesertaBayar');
    }
}