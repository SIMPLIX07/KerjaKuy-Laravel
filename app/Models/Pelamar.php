<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'password',
        'foto_profil'
    ];

    public function keahlians()
    {
        return $this->belongsToMany(Keahlian::class, 'pelamar_keahlian');
    }
    public function lamarans()
    {
        return $this->hasMany(Lamaran::class, 'pelamar_id');
    }
    public function cv()
    {
        return $this->hasMany(Cv::class);
    }
    public function wawancaras()
    {
        return $this->hasMany(Wawancara::class);
    }
}
