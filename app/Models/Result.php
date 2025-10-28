<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mahasiswa',
        'id_form',
        'total_nilai',
        'golongan',
    ];
    // Relasi ke tabel mahasiswa (College)
    public function mahasiswa()
    {
        return $this->belongsTo(College::class, 'id_mahasiswa');
    }

    // Relasi ke tabel form
    public function form()
    {
        return $this->belongsTo(Form::class, 'id_form');
    }
    public static function tentukanGolongan($skor)
    {
        if ($skor > 0.875) return 'GOL 1';
        if ($skor > 0.75) return 'GOL 2';
        if ($skor > 0.625) return 'GOL 3';
        if ($skor > 0.5) return 'GOL 4';
        if ($skor > 0.375) return 'GOL 5';
        if ($skor > 0.25) return 'GOL 6';
        if ($skor > 0.125) return 'GOL 7';
        return 'GOL 8';
    }
}
