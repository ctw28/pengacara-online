<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanBayarJabatanAtur extends Model
{
    use HasFactory;

    protected $fillable = [
        'kegiatan_bayar_jabatan_id',
        'honor',
        'jumlah',
        'master_satuan_id'
    ];

    public function kegiatanJabatan()
    {
        return $this->belongsTo('App\Models\KegiatanBayarJabatan');
    }

    public function masterSatuan()
    {
        return $this->belongsTo('App\Models\MasterSatuan');
    }
    
    public function kegiatanBayarJabatan()
    {
        return $this->belongsTo('App\Models\KegiatanBayarJabatan');
    }
}