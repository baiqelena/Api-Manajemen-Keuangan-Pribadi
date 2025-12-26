<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tabungan;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $tabunganDanaDarurat = Tabungan::where('nama_tabungan', 'Dana Darurat')->first();
        $tabunganLiburan = Tabungan::where('nama_tabungan', 'Liburan')->first();

        Transaksi::create([
            'tabungan_id' => $tabunganDanaDarurat->id,
            'jenis' => 'masuk',
            'jumlah' => 500000,
            'keterangan' => 'Setoran awal Dana Darurat'
        ]);

        Transaksi::create([
            'tabungan_id' => $tabunganLiburan->id,
            'jenis' => 'masuk',
            'jumlah' => 200000,
            'keterangan' => 'Setoran awal Liburan'
        ]);

        Transaksi::create([
            'tabungan_id' => $tabunganDanaDarurat->id,
            'jenis' => 'keluar',
            'jumlah' => 100000,
            'keterangan' => 'Pengeluaran darurat'
        ]);
    }
}
