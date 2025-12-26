<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class TabunganController extends Controller
{
    // GET ALL
    public function index()
    {
        JWTAuth::parseToken()->authenticate(); // cek token
        $tabungan = Tabungan::all();
        return response()->json($tabungan);
    }

    // CREATE
    public function store(Request $request)
    {
        JWTAuth::parseToken()->authenticate();

        $data = $request->validate([
            'nama_tabungan' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $tabungan = Tabungan::create($data);

        return response()->json([
            'message' => 'Tabungan berhasil dibuat',
            'data' => $tabungan
        ], 201);
    }

    // DETAIL
    public function show($id)
    {
        JWTAuth::parseToken()->authenticate();
        $tabungan = Tabungan::findOrFail($id);
        return response()->json($tabungan);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        JWTAuth::parseToken()->authenticate();

        $tabungan = Tabungan::findOrFail($id);
        $tabungan->update($request->only([
            'nama_tabungan',
            'jumlah',
            'keterangan'
        ]));

        return response()->json([
            'message' => 'Tabungan berhasil diperbarui',
            'data' => $tabungan
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        JWTAuth::parseToken()->authenticate();

        $tabungan = Tabungan::findOrFail($id);
        $tabungan->delete();

        return response()->json([
            'message' => 'Tabungan berhasil dihapus'
        ]);
    }
}
