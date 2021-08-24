<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFakultas extends Model
{
    use HasFactory;

    protected $fillable = [
        'fakultas_nama',
        'singkatan'
    ];
}