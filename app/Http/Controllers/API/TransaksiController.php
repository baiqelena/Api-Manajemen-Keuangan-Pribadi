<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Tabungan;
use Tymon\JWTAuth\Facades\JWTAuth;

class TransaksiController extends Controller
{
    // GET all transaksi
    public function index()
    {
        JWTAuth::parseToken()->authenticate();
        $transaksi = Transaksi::with('tabungan')->get();
        return response()->json($transaksi);
    }

    // CREATE transaksi
    public function store(Request $request)
    {
        JWTAuth::parseToken()->authenticate();

        // Validasi input
        $request->validate([
            'tabungan_nama' => 'required|string', // kita input nama tabungan
            'jenis' => 'required|string', // masuk / keluar
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        // Ambil tabungan berdasarkan nama
        $tabungan = Tabungan::where('nama_tabungan', $request->tabungan_nama)->first();

        if (!$tabungan) {
            return response()->json(['message' => 'Tabungan tidak ditemukan'], 404);
        }

        $transaksi = Transaksi::create([
            'tabungan_id' => $tabungan->id,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil dibuat',
            'data' => $transaksi
        ], 201);
    }

    // GET detail transaksi
    public function show($id)
    {
        JWTAuth::parseToken()->authenticate();
        $transaksi = Transaksi::with('tabungan')->findOrFail($id);
        return response()->json($transaksi);
    }

        // GET transaksi berdasarkan tabungan_id
    public function getByTabungan($tabungan_id)
    {
        JWTAuth::parseToken()->authenticate();

        $transaksi = Transaksi::with('tabungan')
            ->where('tabungan_id', $tabungan_id)
            ->get();

        if ($transaksi->isEmpty()) {
            return response()->json([
                'message' => 'Transaksi untuk tabungan ini tidak ditemukan'
            ], 404);
        }

        return response()->json($transaksi);
    }


    // UPDATE transaksi
    public function update(Request $request, $id)
    {
        JWTAuth::parseToken()->authenticate();
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'tabungan_nama' => 'sometimes|string',
            'jenis' => 'sometimes|string',
            'jumlah' => 'sometimes|numeric',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->tabungan_nama) {
            $tabungan = Tabungan::where('nama_tabungan', $request->tabungan_nama)->first();
            if (!$tabungan) {
                return response()->json(['message' => 'Tabungan tidak ditemukan'], 404);
            }
            $transaksi->tabungan_id = $tabungan->id;
        }

        if ($request->jenis) $transaksi->jenis = $request->jenis;
        if ($request->jumlah) $transaksi->jumlah = $request->jumlah;
        if ($request->keterangan) $transaksi->keterangan = $request->keterangan;

        $transaksi->save();

        return response()->json([
            'message' => 'Transaksi berhasil diperbarui',
            'data' => $transaksi
        ]);
    }

    // DELETE transaksi
    public function destroy($id)
    {
        JWTAuth::parseToken()->authenticate();
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return response()->json([
            'message' => 'Transaksi berhasil dihapus'
        ]);
    }
}
