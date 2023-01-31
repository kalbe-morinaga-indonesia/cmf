<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'signature_id',
        'department_id',
        'evaluasi'
    ];

    public function department(){
        return $this->belongsTo('App\Models\Department');
    }

    public function signature()
    {
        return $this->belongsTo('App\Models\Signature');
    }
}
