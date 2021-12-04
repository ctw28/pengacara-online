<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutinPejabat extends Model
{
    use HasFactory;
    protected $fillable = [
        'pengaturan_fakultas_id',
        'rutin_jabatan_id',
        'jabatan_keterangan',
        'idpeg',
        'nama',
        'nip',
        'golongan',
        'pajak',
        'honor',
        'status'
    ];

    public function rutinSuratKeterangan()
    {
        return $this->belongsTo('App\Models\RutinSuratKeterangan');
    }

    public function rutinJabatan()
    {
        return $this->belongsTo('App\Models\RutinJabatan');
    }
}
