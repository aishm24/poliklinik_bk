<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    protected $table = 'periksas';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'id_daftar_poli',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    public function daftarPoli(){
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli', 'id');
    }

    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa', 'id');
    }
}
