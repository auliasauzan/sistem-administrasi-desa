<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LetterType;

class LetterTypeController extends Controller
{
    public function index()
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $letterTypes = LetterType::all();
        $title = 'Data Jenis Surat';
        return view('letter_type.index', compact('letterTypes', 'title'));
    }

    public function create()
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $title = 'Tambah Jenis Surat';
        return view('letter_type.create', compact('title'));
    }

    public function store(Request $request)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'name' => 'required|string|max:255',
            'requirements' => 'nullable|string',
        ]);

        LetterType::create($request->all());
        return redirect()->route('letter_type.index')->with('success', 'Jenis Surat berhasil ditambahkan');
    }

    public function edit(LetterType $letterType)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $title = 'Edit Jenis Surat';
        return view('letter_type.edit', compact('letterType', 'title'));
    }

    public function update(Request $request, LetterType $letterType)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'name' => 'required|string|max:255',
            'requirements' => 'nullable|string',
        ]);

        $letterType->update($request->all());
        return redirect()->route('letter_type.index')->with('success', 'Jenis Surat berhasil diubah');
    }

    public function destroy(LetterType $letterType)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $letterType->delete();
        return redirect()->route('letter_type.index')->with('success', 'Jenis Surat berhasil dihapus');
    }
}
