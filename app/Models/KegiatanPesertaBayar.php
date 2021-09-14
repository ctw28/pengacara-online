<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPesertaBayar extends Model
{
    use HasFactory;

    protected $fillable= [
        'kegiatan_pembayaran_sesi_id',
        'kegiatan_peserta_id',
        'master_satuan_id',
        'honor',
        'jumlah'
    ];

    public function kegiatanPembayaranSesi()
    {
        return $this->belongsTo('App\Models\KegiatanPembayaranSesi');
    }
    public function kegiatanPeserta()
    {
        return $this->belongsTo('App\Models\KegiatanPeserta');
    }
    public function masterSatuan()
    {
        return $this->belongsTo('App\Models\MasterSatuan');
    }

}