<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutinSuratKeterangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pengaturan_fakultas_id',
        'sk',
        'sk_tanggal',
        'sub_kegiatan',
        'no_bukti',
        'akun',
        'is_aktif'
    ];

    public function pengaturanFakultasId()
    {
        return $this->belongsTo('App\Models\PengaturanFakultas');
    }

    public function rutinPejabat()
    {
        return $this->hasMany('App\Models\RutinPejabat');
    }
}
