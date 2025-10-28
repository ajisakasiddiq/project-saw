<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAhp extends Model
{
    use HasFactory;

    public $table = "sub_ahps";

    protected $fillable = [
        'id_sub1',
        'id_sub2',
        'nilai1',
        'nilai2'
    ];
}
