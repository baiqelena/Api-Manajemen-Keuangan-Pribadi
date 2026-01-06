<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Investasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvestasiController extends Controller
{
    // GET: /api/investasi
    public function index()
    {
        $data = Investasi::orderBy('tanggal', 'desc')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data investasi',
            'data' => $data
        ], 200);
    }

    // POST: /api/investasi
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal'           => 'required|date',
            'jenis_investasi'   => 'required|string|max:100',
            'nama_aset'         => 'required|string|max:150',
            'jumlah_investasi'  => 'required|numeric|min:0',
            'nilai_awal'        => 'required|numeric|min:0',
            'nilai_sekarang'    => 'nullable|numeric|min:0',
            'keterangan'        => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = Investasi::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Investasi berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    // GET: /api/investasi/{id}
    public function show($id)
    {
        $data = Investasi::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data investasi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    // PUT: /api/investasi/{id}
    public function update(Request $request, $id)
    {
        $data = Investasi::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data investasi tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tanggal'           => 'required|date',
            'jenis_investasi'   => 'required|string|max:100',
            'nama_aset'         => 'required|string|max:150',
            'jumlah_investasi'  => 'required|numeric|min:0',
            'nilai_awal'        => 'required|numeric|min:0',
            'nilai_sekarang'    => 'nullable|numeric|min:0',
            'keterangan'        => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Investasi berhasil diupdate',
            'data' => $data
        ], 200);
    }

    // DELETE: /api/investasi/{id}
    public function destroy($id)
    {
        $data = Investasi::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data investasi tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Investasi berhasil dihapus'
        ], 200);
    }
}
