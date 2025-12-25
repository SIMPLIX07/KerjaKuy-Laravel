<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    protected $fillable = [
        'user_id',
        'umur',
        'tentang_saya',
        'kontak',
        'title',
        'subtitle'
    ];

    public function pendidikans()
    {
        return $this->hasMany(Pendidikan::class);
    }

    public function skills()
    {
        return $this->hasMany(SkillCv::class);
    }

    public function pengalamans()
    {
        return $this->hasMany(Pengalaman::class);
    }
}
