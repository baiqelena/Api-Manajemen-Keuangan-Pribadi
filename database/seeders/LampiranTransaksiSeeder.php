<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LampiranTransaksi;
use App\Models\Transaksi;

class LampiranTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $transaksis = Transaksi::all();

        foreach ($transaksis as $transaksi) {
            LampiranTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'jenis_lampiran' => 'Bukti Pembayaran ' . $transaksi->id,
                'tanggal' => now()->toDateString()
            ]);
        }
    }
}
