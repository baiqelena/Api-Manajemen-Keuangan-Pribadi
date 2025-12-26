<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hutang;

class HutangSeeder extends Seeder
{
    public function run(): void
    {
        Hutang::create([
            'nama_pemberi_hutang' => 'Hafiz',
            'tanggal_pinjam' => '2025-01-25',
            'keterangan' => 'Pinjam untuk foya-foya'
        ]);

        Hutang::create([
            'nama_pemberi_hutang' => 'Farel',
            'tanggal_pinjam' => '2025-02-10',
            'keterangan' => 'Pinjam modal usaha'
        ]);
    }
}
