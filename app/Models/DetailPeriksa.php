<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    protected $table = 'detail_periksas';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'id_periksa',
        'id_obat',
    ];

    public function periksa()
    {
        return $this->belongsTo(Periksa::class, 'id_periksa', 'id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id');
    }
}
