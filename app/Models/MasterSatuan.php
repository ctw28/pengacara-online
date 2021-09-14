<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSatuan extends Model
{
    use HasFactory;
    protected $fillable = [
        'master_satuan_nama',
        'master_satuan_singkatan',
    ];
}