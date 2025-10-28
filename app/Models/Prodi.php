<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    public $table = "prodi";

    protected $fillable = [
        'id_jurusan',
        'nama_prodi',
    ];
}
