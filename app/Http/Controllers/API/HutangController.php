<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hutang;

class HutangController extends Controller
{
    // Get all
    public function index()
    {
        return response()->json(Hutang::all());
    }

    // Create
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemberi_hutang' => 'required|string',
            'tanggal_pinjam' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $hutang = Hutang::create([
            'nama_pemberi_hutang' => $request->nama_pemberi_hutang,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'keterangan' => $request->keterangan
        ]);

        return response()->json([
            'message' => 'Data hutang berhasil dibuat',
            'data' => $hutang
        ], 201);
    }

    // Detail
    public function show($id)
    {
        $hutang = Hutang::findOrFail($id);
        return response()->json($hutang);
    }

    // Update
    public function update(Request $request, $id)
    {
        $hutang = Hutang::findOrFail($id);
        $hutang->update($request->all());

        return response()->json([
            'message' => 'Data hutang berhasil diperbarui',
            'data' => $hutang
        ]);
    }

    // Delete
    public function destroy($id)
    {
        $hutang = Hutang::findOrFail($id);
        $hutang->delete();

        return response()->json([
            'message' => 'Data hutang berhasil dihapus'
        ]);
    }
}
