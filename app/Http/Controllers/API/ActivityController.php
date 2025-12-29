<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Menampilkan semua aktivitas milik user yang login
     */
    public function index()
    {
        $activities = Activity::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'message' => 'Data aktivitas berhasil diambil',
            'data' => $activities
        ], 200);
    }

    /**
     * Menyimpan aktivitas baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity' => 'required|string|max:255'
        ]);

        $activity = Activity::create([
            'user_id' => auth()->id(),
            'activity' => $request->activity
        ]);

        return response()->json([
            'message' => 'Aktivitas berhasil ditambahkan',
            'data' => $activity
        ], 201);
    }

    /**
     * Menampilkan detail aktivitas berdasarkan ID
     */
    public function show($id)
    {
        $activity = Activity::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$activity) {
            return response()->json([
                'message' => 'Aktivitas tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail aktivitas',
            'data' => $activity
        ], 200);
    }

    /**
     * Mengupdate aktivitas
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'activity' => 'required|string|max:255'
        ]);

        $activity = Activity::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$activity) {
            return response()->json([
                'message' => 'Aktivitas tidak ditemukan'
            ], 404);
        }

        $activity->update([
            'activity' => $request->activity
        ]);

        return response()->json([
            'message' => 'Aktivitas berhasil diupdate',
            'data' => $activity
        ], 200);
    }

    /**
     * Menghapus aktivitas
     */
    public function destroy($id)
    {
        $activity = Activity::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$activity) {
            return response()->json([
                'message' => 'Aktivitas tidak ditemukan'
            ], 404);
        }

        $activity->delete();

        return response()->json([
            'message' => 'Aktivitas berhasil dihapus'
        ], 200);
    }
}
