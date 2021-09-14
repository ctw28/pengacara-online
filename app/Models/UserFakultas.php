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
        'master_fakultas_id',
        'is_aktif'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function fakultas()
    {
        return $this->belongsTo('App\Models\MasterFakultas', 'master_fakultas_id', 'id');
    }
}