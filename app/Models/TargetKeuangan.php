<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetKeuangan extends Model
{
    use HasFactory;

    protected $table = 'target_keuangan';

    protected $fillable = [
        'nama_target',
        'target_dana',
        'dana_terkumpul',
        'tanggal_mulai',
        'tanggal_target',
        'status'
    ];
}
