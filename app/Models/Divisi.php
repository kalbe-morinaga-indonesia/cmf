<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'txtIdDivisi',
        'txtNamaDivisi'
    ];

    public function departments(){
        return $this->hasMany('App\Models\Department');
    }
}
