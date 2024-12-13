<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    protected $table = 'jadwal_periksas';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id');
    }

    public function daftarPolis()
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal', 'id');
    }
}
