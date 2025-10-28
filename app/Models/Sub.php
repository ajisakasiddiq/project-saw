<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    use HasFactory;

    public $table = "sub";

    protected $fillable = [
        'id_kriteria',
        'nama_sub',
        'bobot',
    ];
}
