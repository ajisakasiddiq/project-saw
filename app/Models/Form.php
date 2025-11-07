<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    public $table = "form";

    protected $fillable = [
        'nama_form',
        'jenis',
        'status',
        'kuota',
    ];
    public function alternatif()
    {
        return $this->hasOne(Alternatif::class, 'id_form', 'id');
    }
}
