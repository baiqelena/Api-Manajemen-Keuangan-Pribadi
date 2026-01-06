<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    // 🔹 Ambil semua data pengeluaran
    public function index()
    {
        $data = Pengeluaran::orderBy('tanggal', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data pengeluaran berhasil diambil',
            'data' => $data
        ], 200);
    }

    // 🔹 Simpan data pengeluaran
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal'   => 'required|date',
            'kategori'  => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'jumlah'    => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $pengeluaran = Pengeluaran::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data pengeluaran berhasil disimpan',
            'data' => $pengeluaran
        ], 201);
    }

    // 🔹 Detail pengeluaran berdasarkan ID
    public function show($id)
    {
        $pengeluaran = Pengeluaran::find($id);

        if (!$pengeluaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengeluaran tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pengeluaran
        ], 200);
    }

    // 🔹 Update data pengeluaran
    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::find($id);

        if (!$pengeluaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengeluaran tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tanggal'   => 'required|date',
            'kategori'  => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'jumlah'    => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $pengeluaran->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data pengeluaran berhasil diperbarui',
            'data' => $pengeluaran
        ], 200);
    }

    // 🔹 Hapus data pengeluaran
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id);

        if (!$pengeluaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengeluaran tidak ditemukan'
            ], 404);
        }

        $pengeluaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pengeluaran berhasil dihapus'
        ], 200);
    }
}
