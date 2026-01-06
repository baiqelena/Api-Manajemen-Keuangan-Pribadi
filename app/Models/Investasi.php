<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investasi extends Model
{
    use HasFactory;

    protected $table = 'investasi';

    protected $fillable = [
        'tanggal',
        'jenis_investasi',
        'nama_aset',
        'jumlah_investasi',
        'nilai_awal',
        'nilai_sekarang',
        'keterangan'
    ];
}
