<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TargetKeuangan;
use Illuminate\Http\Request;

class TargetKeuanganController extends Controller
{
    // CREATE
    public function store(Request $request)
    {
        $request->validate([
            'nama_target' => 'required|string',
            'target_dana' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_target' => 'required|date'
        ]);

        $data = TargetKeuangan::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Target keuangan berhasil dibuat',
            'data' => $data
        ], 201);
    }

    // READ ALL
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => TargetKeuangan::all()
        ], 200);
    }

    // READ BY ID
    public function show($id)
    {
        $data = TargetKeuangan::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Target tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $data = TargetKeuangan::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Target tidak ditemukan'
            ], 404);
        }

        $data->update($request->all());

        // cek tercapai
        if ($data->dana_terkumpul >= $data->target_dana) {
            $data->status = 'tercapai';
            $data->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Target keuangan berhasil diupdate',
            'data' => $data
        ], 200);
    }

    // DELETE
    public function destroy($id)
    {
        $data = TargetKeuangan::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Target tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Target keuangan berhasil dihapus'
        ], 200);
    }
}
