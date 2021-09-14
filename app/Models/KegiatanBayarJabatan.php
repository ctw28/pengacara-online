<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanBayarJabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kegiatan_jabatan_id',
        'm_bayar_kategori_id'
    ];

    public function kegiatanJabatan()
    {
        return $this->belongsTo('App\Models\KegiatanJabatan');
    }

    public function mBayarKategori()
    {
        return $this->belongsTo('App\Models\MBayarKategori');
    }
    
    public function kegiatanBayarJabatanAtur()
    {
        return $this->hasOne('App\Models\KegiatanBayarJabatanAtur');
    }
    
    public function kegiatanPembayaranSesi()
    {
        return $this->hasOne('App\Models\KegiatanPembayaranSesi');
    }
}