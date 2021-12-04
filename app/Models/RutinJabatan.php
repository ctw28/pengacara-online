<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutinJabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pengaturan_fakultas_id',
        'jabatan_nama',
        'jabatan_keterangan'
    ];

    public function pengaturanFakultas()
    {
        return $this->belongsTo('App\Models\PengaturanFakultas');
    }

    public function rutinPejabat()
    {
        return $this->hasMany('App\Models\RutinPejabat');
    }
}
