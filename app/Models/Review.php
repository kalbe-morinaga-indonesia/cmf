<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'signature_id',
        'department_id',
        'review'
    ];

    public function department(){
        return $this->belongsTo('App\Models\Department');
    }

    public function signature()
    {
        return $this->belongsTo('App\Models\Signature');
    }
}
