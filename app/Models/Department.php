<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'txtIdDept',
        'divisi_id',
        'txtNamaDept',
    ];

    public function divisi(){
        return $this->belongsTo('App\Models\Divisi');
    }
}
