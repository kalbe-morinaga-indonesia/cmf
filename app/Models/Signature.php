<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $fillable = [
        'cmf_id',
        'user_id',
        'is_signature',
        'step',
        'keterangan',
        'catatan'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function review()
    {
        return $this->hasOne('App\Models\Review');
    }
}
