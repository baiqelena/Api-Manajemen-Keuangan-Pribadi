<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'tabungan_id',
        'jenis',
        'jumlah',
        'keterangan',
    ];

    public function tabungan()
    {
        return $this->belongsTo(Tabungan::class);
    }
}
