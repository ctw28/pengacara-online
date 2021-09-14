<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanFakultas extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tahun_anggaran_pengaturan_id',
        'pengaturan_jabatan_id',
        'master_fakultas_id'
    ];

    public function tahunAnggaranPengaturan()
    {
        return $this->belongsTo('App\Models\TahunAnggaranPengaturan');
    }
    
    public function pengaturanJabatan()
    {
        return $this->belongsTo('App\Models\PengaturanJabatan');
    }
    
    public function fakultas()
    {
        return $this->belongsTo('App\Models\MasterFakultas','master_fakultas_id');
    }
}