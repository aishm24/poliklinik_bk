<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'polis';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    public function dokters()
    {
        return $this->hasMany(Dokter::class, 'id_poli', 'id');
    }    
}
