<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaAhp extends Model
{
    use HasFactory;

    public $table = "kriteria_ahps";

    protected $fillable = [
        'id_kriteria1',
        'id_kriteria2',
        'nilai1',
        'nilai2'
    ];
}
