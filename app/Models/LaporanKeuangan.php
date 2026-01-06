<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_keuangan';

    protected $fillable = [
        'tahun',
        'bulan',
        'total_pengeluaran',
        'total_investasi',
        'saldo_akhir'
    ];
}
