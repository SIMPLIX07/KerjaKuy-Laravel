<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class perusahaan extends Model
{
        protected $fillable = [
        'nama_perusahaan',
        'email',
        'password',
        'alamat',
        'telepon',
        'npwp',
        'sertifikat'
    ];
}
