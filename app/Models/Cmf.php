<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cmf extends Model
{
    protected $fillable = [
        'no_cmf',
        'judul_perubahan',
        'perubahan',
        'tanggal',
        'jenis_perubahan',
        'target_implementasi',
        'tipe_perubahan',
        'alasan_perubahan',
        'dampak_terhadap_perubahan',
        'deskripsi_perubahan',
        'status_pengajuan',
        'department_id',
        'subdepartment_id',
        'inserted_by',
        'updated_by'
    ];

    // relationship
    public function risks(){
        return $this->hasMany('App\Models\Risk');
    }

    public function departments(){
        return $this->belongsToMany('App\Models\Department')->withTimestamps();
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function subdepartments(){
        return $this->belongsToMany('App\Models\Subdepartment')->withTimestamps();
    }
}
