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
        'status_verifikasi',
        'alasan_penolakan',
        'verified_by',
        'verified_at',
    ];

    public function lowongans()
    {
        return $this->hasMany(Lowongan::class, 'perusahaan_id');
    }
    public function wawancaras()
    {
        return $this->hasMany(Wawancara::class);
    }
}
