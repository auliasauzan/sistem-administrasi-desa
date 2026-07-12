<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Resident;
use App\Models\Family;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::with('family')->get();
        return view('resident.index', [
            'title' => 'Data Penduduk',
            'residents' => $residents
        ]);
    }

    public function create()
    {
        return view('resident.create', [
            'title' => 'Tambah Data Penduduk',
            'families' => Family::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'family_id' => 'required|exists:families,id',
            'national_id' => 'required|unique:residents,national_id',
            'full_name' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'religion' => 'required|string',
            'occupation' => 'required|string',
        ], [
            'family_id.required' => 'Pilih Kartu Keluarga',
            'national_id.required' => 'NIK wajib diisi',
            'national_id.unique' => 'NIK sudah terdaftar',
            'full_name.required' => 'Nama lengkap wajib diisi',
            'birth_date.required' => 'Tanggal lahir wajib diisi',
            'gender.required' => 'Jenis kelamin wajib diisi',
            'religion.required' => 'Agama wajib diisi',
            'occupation.required' => 'Pekerjaan wajib diisi',
        ]);

        Resident::create($validated);
        return to_route('resident.index')->withSuccess('Data berhasil ditambahkan');
    }

    public function edit(Resident $resident)
    {
        return view('resident.edit', [
            'title' => 'Edit Data Penduduk',
            'resident' => $resident,
            'families' => Family::all()
        ]);
    }

    public function update(Request $request, Resident $resident)
    {
        $validated = $request->validate([
            'family_id' => 'required|exists:families,id',
            'national_id' => 'required|unique:residents,national_id,' . $resident->id,
            'full_name' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'religion' => 'required|string',
            'occupation' => 'required|string',
        ], [
            'family_id.required' => 'Kepala Keluarga wajib dipilih',
            'family_id.exists' => 'Data Kepala Keluarga tidak valid',
            'national_id.required' => 'NIK wajib diisi',
            'national_id.unique' => 'NIK sudah terdaftar',
            'full_name.required' => 'Nama lengkap wajib diisi',
            'birth_date.required' => 'Tanggal lahir wajib diisi',
            'gender.required' => 'Jenis kelamin wajib dipilih',
            'religion.required' => 'Agama wajib dipilih',
            'occupation.required' => 'Pekerjaan wajib diisi',
        ]);

        $resident->update($validated);
        return to_route('resident.index')->withSuccess('Data berhasil diubah');
    }

    public function destroy(Resident $resident)
    {
        $resident->delete();
        return to_route('resident.index')->withSuccess('Data berhasil dihapus');
    }
}
