<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdepartment extends Model
{
    use HasFactory;
    protected $fillable = [
        'txtIdSubDept',
        'txtNamaSubDept',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
