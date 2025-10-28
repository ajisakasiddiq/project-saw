<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    public $table = "mahasiswa";

    protected $fillable = [
        'nim',
        'nama',
        'id_jurusan',
        'id_prodi',
        'angkatan',
        'semester',
        'jalur_masuk',
        'ukt_sekarang',
        'ponsel',
        'alamat',
    ];
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }
}
