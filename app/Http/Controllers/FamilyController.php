<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Family;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::all();
        return view('family.index', [
            'title' => 'Data Keluarga',
            'families' => $families
        ]);
    }

    public function create()
    {
        return view('family.create', [
            'title' => 'Tambah Data Keluarga'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'family_card_number' => 'required|unique:families,family_card_number',
            'address' => 'required|string',
            'neighborhood' => 'required|string',
        ], [
            'family_card_number.required' => 'NKK wajib diisi',
            'family_card_number.unique' => 'NKK sudah terdaftar',
            'address.required' => 'Alamat wajib diisi',
            'neighborhood.required' => 'RT/RW wajib diisi',
        ]);

        Family::create($validated);
        return to_route('family.index')->withSuccess('Data berhasil ditambahkan');
    }

    public function edit(Family $family)
    {
        return view('family.edit', [
            'title' => 'Edit Data Keluarga',
            'family' => $family
        ]);
    }

    public function update(Request $request, Family $family)
    {
        $validated = $request->validate([
            'family_card_number' => 'required|unique:families,family_card_number,' . $family->id,
            'address' => 'required|string',
            'neighborhood' => 'required|string',
        ], [
            'family_card_number.required' => 'NKK wajib diisi',
            'family_card_number.unique' => 'NKK sudah terdaftar',
            'address.required' => 'Alamat wajib diisi',
            'neighborhood.required' => 'RT/RW wajib diisi',
        ]);

        $family->update($validated);
        return to_route('family.index')->withSuccess('Data berhasil diubah');
    }

    public function destroy(Family $family)
    {
        $family->delete();
        return to_route('family.index')->withSuccess('Data berhasil dihapus');
    }
}
