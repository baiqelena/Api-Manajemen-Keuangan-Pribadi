<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LaporanKeuangan;
use App\Models\Pengeluaran;
use App\Models\Investasi;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    // 🔹 Generate & simpan laporan per bulan
    public function generate(Request $request)
    {
        $request->validate([
            'tahun' => 'required|numeric',
            'bulan' => 'required|numeric|min:1|max:12'
        ]);

        $totalPengeluaran = Pengeluaran::whereYear('tanggal', $request->tahun)
            ->whereMonth('tanggal', $request->bulan)
            ->sum('jumlah');

        $totalInvestasi = Investasi::whereYear('tanggal', $request->tahun)
            ->whereMonth('tanggal', $request->bulan)
            ->sum('jumlah_investasi');

        $saldoAkhir = $totalInvestasi - $totalPengeluaran;

        $laporan = LaporanKeuangan::updateOrCreate(
            [
                'tahun' => $request->tahun,
                'bulan' => $request->bulan
            ],
            [
                'total_pengeluaran' => $totalPengeluaran,
                'total_investasi' => $totalInvestasi,
                'saldo_akhir' => $saldoAkhir
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Laporan keuangan berhasil digenerate',
            'data' => $laporan
        ], 200);
    }

    // 🔹 Ambil semua laporan
    public function index()
    {
        $data = LaporanKeuangan::orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    // 🔹 Ambil laporan by ID
    public function show($id)
    {
        $laporan = LaporanKeuangan::find($id);

        if (!$laporan) {
            return response()->json([
                'status' => false,
                'message' => 'Data laporan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $laporan
        ], 200);
    }

    // 🔹 Hapus laporan
    public function destroy($id)
    {
        $laporan = LaporanKeuangan::find($id);

        if (!$laporan) {
            return response()->json([
                'status' => false,
                'message' => 'Data laporan tidak ditemukan'
            ], 404);
        }

        $laporan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Laporan keuangan berhasil dihapus'
        ], 200);
    }
}
