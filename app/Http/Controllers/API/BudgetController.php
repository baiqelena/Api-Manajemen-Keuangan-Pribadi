<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    // GET /api/budget
    public function index()
    {
        return response()->json([
            'data' => Budget::where('user_id', auth()->id())->get()
        ]);
    }

    // POST /api/budget
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:100',
            'limit_amount' => 'required|numeric|min:0',
            'month' => 'required|string'
        ]);

        $budget = Budget::create([
            'user_id' => auth()->id(), // ← INI KUNCI
            'category' => $validated['category'],
            'limit_amount' => $validated['limit_amount'],
            'month' => $validated['month'],
        ]);

        return response()->json([
            'message' => 'Budget berhasil ditambahkan',
            'data' => $budget
        ], 201);
    }

    // PUT /api/budget/{id}
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category' => 'sometimes|required|string|max:100',
            'limit_amount' => 'sometimes|required|numeric|min:0',
            'month' => 'sometimes|required|string'
        ]);

        $budget = Budget::where('id', $id)
            ->where('user_id', auth()->id()) // ← SECURITY
            ->firstOrFail();

        $budget->update($validated);

        return response()->json([
            'message' => 'Budget berhasil diperbarui',
            'data' => $budget
        ]);
    }

    // DELETE /api/budget/{id}
    public function destroy($id)
    {
        $budget = Budget::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $budget->delete();

        return response()->json([
            'message' => 'Budget berhasil dihapus'
        ]);
    }
}
