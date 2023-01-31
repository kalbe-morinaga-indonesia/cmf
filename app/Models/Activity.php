<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'cmf_id',
        'tanggal_instalasi',
        'tanggal_trial',
        'tanggal_implementasi'
    ];
}
