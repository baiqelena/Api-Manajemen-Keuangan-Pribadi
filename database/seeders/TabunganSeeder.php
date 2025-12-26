<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tabungan;

class TabunganSeeder extends Seeder
{
    public function run(): void
    {
        Tabungan::create([
            'nama_tabungan' => 'Dana Darurat',
            'jumlah' => 1000000,
            'keterangan' => 'Tabungan untuk kebutuhan mendesak'
        ]);

        Tabungan::create([
            'nama_tabungan' => 'Liburan',
            'jumlah' => 500000,
            'keterangan' => 'Tabungan untuk liburan'
        ]);
    }
}
