<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LampiranTransaksi;
use Illuminate\Http\Request;

class LampiranTransaksiController extends Controller
{
    // GET all
    public function index()
    {
        return response()->json(LampiranTransaksi::all());
    }

    // POST create
    public function store(Request $request)
    {
        $request->validate([
            'jenis_lampiran' => 'required|string',
            'tanggal' => 'required|date'
        ]);

        // Ambil transaksi terakhir (bisa diganti sesuai kebutuhan)
        $transaksi = \App\Models\Transaksi::latest()->first();

        if (!$transaksi) {
            return response()->json([
                'message' => 'Belum ada transaksi tersedia untuk dihubungkan'
            ], 400);
        }

        $lampiran = \App\Models\LampiranTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'jenis_lampiran' => $request->jenis_lampiran,
            'tanggal' => $request->tanggal
        ]);

        return response()->json([
            'message' => 'Lampiran transaksi berhasil dibuat',
            'data' => $lampiran
        ], 201);
    }


    // GET by ID
    public function show($id)
    {
        $lampiran = LampiranTransaksi::findOrFail($id);
        return response()->json($lampiran);
    }

        // GET lampiran berdasarkan transaksi_id
    public function getByTransaksi($transaksi_id)
    {
        $lampirans = \App\Models\LampiranTransaksi::where('transaksi_id', $transaksi_id)->get();

        if ($lampirans->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada lampiran untuk transaksi ini'
            ], 404);
        }

        return response()->json($lampirans);
    }

    // PUT update
    public function update(Request $request, $id)
    {
        $lampiran = LampiranTransaksi::findOrFail($id);
        $lampiran->update($request->all());

        return response()->json([
            'message' => 'Lampiran transaksi berhasil diperbarui',
            'data' => $lampiran
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        $lampiran = LampiranTransaksi::findOrFail($id);
        $lampiran->delete();

        return response()->json([
            'message' => 'Lampiran transaksi berhasil dihapus'
        ]);
    }
}
