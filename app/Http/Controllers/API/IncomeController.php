<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    // GET /income
    public function index()
    {
        $incomes = Income::where('user_id', auth()->id())->get();

        return response()->json([
            'success' => true,
            'data' => $incomes
        ]);
    }

    // POST /income
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'date' => 'required|date'
        ]);

        $income = Income::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Income berhasil ditambahkan',
            'data' => $income
        ], 201);
    }

    // PUT /income/{id}
    public function update(Request $request, $id)
    {
        $income = Income::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'date' => 'required|date'
        ]);

        $income->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Income berhasil diupdate',
            'data' => $income
        ]);
    }

    // DELETE /income/{id}
    public function destroy($id)
    {
        $income = Income::where('user_id', auth()->id())->findOrFail($id);
        $income->delete();

        return response()->json([
            'success' => true,
            'message' => 'Income berhasil dihapus'
        ]);
    }
}
