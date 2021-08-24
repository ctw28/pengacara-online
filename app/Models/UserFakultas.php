<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFakultas extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'idpeg',
        'master_fakultas_id'
    ];
}