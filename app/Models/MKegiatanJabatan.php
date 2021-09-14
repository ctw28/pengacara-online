<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKegiatanJabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kegiatan_jabatan_nama'
    ];
}