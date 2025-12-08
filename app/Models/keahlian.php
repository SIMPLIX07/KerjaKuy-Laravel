<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keahlian extends Model
{
    protected $fillable = ['nama_keahlian'];

    public function pelamars()
    {
        return $this->belongsToMany(Pelamar::class, 'pelamar_keahlian');
    }
}
