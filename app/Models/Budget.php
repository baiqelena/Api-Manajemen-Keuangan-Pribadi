<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Budget extends Model
{
    use HasFactory;

    // Nama tabel (opsional, tapi aman kalau mau eksplisit)
    protected $table = 'budgets';

    /**
     * Kolom yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'user_id',
        'category',
        'limit_amount',
        'month'
    ];

    /**
     * Relasi: Budget dimiliki oleh satu User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
