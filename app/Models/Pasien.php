<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasiens';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'nama',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm',
    ];

    public function daftarPolis()
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_pasien');
    }

    public function konsultasi()
    {
        return $this->hasMany(Konsultasi::class, 'id_pasien', 'id');
    }
}
