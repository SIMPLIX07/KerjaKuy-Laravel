<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keahlian extends Model
{
    protected $fillable = [
        'pelamar_id',
        'nama_keahlian'
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }
}
