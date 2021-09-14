<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanJabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'master_jabatan_id',
        'idpeg',
        'is_aktif',
        'keterangan'
    ];

    public function masterJabatan()
    {
        return $this->belongsTo('App\Models\MasterJabatan');
    }
}