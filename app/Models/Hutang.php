<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    protected $fillable = [
    'nama_pemberi_hutang',
    'tanggal_pinjam',
    'keterangan'
        
    ];
}

