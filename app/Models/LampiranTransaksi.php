<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampiranTransaksi extends Model
{
    use HasFactory;

    protected $table = 'lampiran_transaksi';

    protected $fillable = [
        'transaksi_id',
        'jenis_lampiran',
        'tanggal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
