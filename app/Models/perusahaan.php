<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $fillable = [
        'nama_perusahaan',
        'email',
        'password',
        'alamat',
        'telepon',
        'npwp',
        'sertifikat',
        'foto_profil',
    ];

    public function lowongans()
    {
        return $this->hasMany(Lowongan::class, 'perusahaan_id');
    }
}
