<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Budget;

class BudgetController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));
        
        $budgets = Budget::where('year', $year)->get();
        $totalIncome = $budgets->where('budget_type', 'income')->sum('amount');
        $totalExpense = $budgets->where('budget_type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;
        
        $availableYears = Budget::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        if (!$availableYears->contains($year)) {
            $availableYears->push((int)$year);
        }

        $title = 'Anggaran & Transparansi Desa';
        return view('budget.index', compact('budgets', 'totalIncome', 'totalExpense', 'balance', 'year', 'availableYears', 'title'));
    }

    public function create()
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $title = 'Tambah Anggaran';
        return view('budget.create', compact('title'));
    }

    public function store(Request $request)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'budget_type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'year' => 'required|integer|min:2000',
            'description' => 'required|string',
        ]);

        Budget::create($request->all());

        return redirect()->route('budget.index', ['year' => $request->year])->with('success', 'Data anggaran berhasil ditambahkan');
    }

    public function edit(Budget $budget)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $title = 'Edit Anggaran';
        return view('budget.edit', compact('budget', 'title'));
    }

    public function update(Request $request, Budget $budget)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'budget_type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'year' => 'required|integer|min:2000',
            'description' => 'required|string',
        ]);

        $budget->update($request->all());

        return redirect()->route('budget.index', ['year' => $budget->year])->with('success', 'Data anggaran berhasil diubah');
    }

    public function destroy(Budget $budget)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $year = $budget->year;
        $budget->delete();

        return redirect()->route('budget.index', ['year' => $year])->with('success', 'Data anggaran berhasil dihapus');
    }
}
