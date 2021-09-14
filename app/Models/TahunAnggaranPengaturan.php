<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAnggaranPengaturan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_anggaran_id',
        'pengaturan_jabatan_id'
    ];

    public function tahunAnggaran()
    {
        return $this->belongsTo('App\Models\MasterTahunAnggaran');
    }
    
    public function pengaturanJabatan()
    {
        return $this->belongsTo('App\Models\PengaturanJabatan');
    }
    
}