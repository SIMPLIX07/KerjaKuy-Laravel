<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = [
        'id_pelamar',
        'id_lowongan',
        'id_perusahaan',
        'kategori_pekerjaan',
        'posisi',
        'tanggal_mulai',
        'status_karyawan'
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'id_pelamar');
    }
}
