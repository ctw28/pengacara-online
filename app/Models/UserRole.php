<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_role'
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}