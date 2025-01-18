<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokters';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'id_poli',
        'nama',
        'alamat',
        'no_hp',
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id');
    }

    public function jadwalPeriksas()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_dokter');
    }

    public function konsultasi()
    {
        return $this->hasMany(Konsultasi::class, 'id_dokter', 'id');
    }
}
