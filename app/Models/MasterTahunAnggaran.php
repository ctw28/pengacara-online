<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTahunAnggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun',
        'tahun_anggaran_nama'
    ];

}