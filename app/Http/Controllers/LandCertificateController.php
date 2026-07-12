<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LandCertificate;
use App\Models\Resident;

class LandCertificateController extends Controller
{
    public function index(Request $request)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $query = LandCertificate::with('owner');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('certificate_number', 'like', "%{$search}%")
                  ->orWhereHas('owner', function($q) use ($search) {
                      $q->where('full_name', 'like', "%{$search}%")
                        ->orWhere('national_id', 'like', "%{$search}%");
                  });
        }

        $landCertificates = $query->paginate(10)->withQueryString();
        $title = 'Data Sertifikat Tanah';

        return view('land_certificate.index', compact('landCertificates', 'title'));
    }

    public function create()
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $residents = Resident::all();
        $title = 'Tambah Data Sertifikat Tanah';
        return view('land_certificate.create', compact('residents', 'title'));
    }

    public function store(Request $request)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'owner_id' => 'required|exists:residents,id',
            'certificate_number' => 'required|string|unique:land_certificates',
            'area_size' => 'required|numeric|min:0',
            'location' => 'required|string',
        ], [
            'owner_id.required' => 'Pemilik wajib dipilih',
            'owner_id.exists' => 'Data pemilik tidak valid',
            'certificate_number.required' => 'Nomor sertifikat wajib diisi',
            'certificate_number.unique' => 'Nomor sertifikat sudah terdaftar',
            'area_size.required' => 'Luas tanah wajib diisi',
            'area_size.numeric' => 'Luas tanah harus berupa angka',
            'location.required' => 'Lokasi wajib diisi',
        ]);

        LandCertificate::create($request->all());

        return redirect()->route('land_certificate.index')->with('success', 'Data Sertifikat Tanah berhasil ditambahkan');
    }

    public function edit(LandCertificate $landCertificate)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $residents = Resident::all();
        $title = 'Edit Data Sertifikat Tanah';
        return view('land_certificate.edit', compact('landCertificate', 'residents', 'title'));
    }

    public function update(Request $request, LandCertificate $landCertificate)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'owner_id' => 'required|exists:residents,id',
            'certificate_number' => 'required|string|unique:land_certificates,certificate_number,' . $landCertificate->id,
            'area_size' => 'required|numeric|min:0',
            'location' => 'required|string',
        ], [
            'owner_id.required' => 'Pemilik wajib dipilih',
            'owner_id.exists' => 'Data pemilik tidak valid',
            'certificate_number.required' => 'Nomor sertifikat wajib diisi',
            'certificate_number.unique' => 'Nomor sertifikat sudah terdaftar',
            'area_size.required' => 'Luas tanah wajib diisi',
            'area_size.numeric' => 'Luas tanah harus berupa angka',
            'location.required' => 'Lokasi wajib diisi',
        ]);

        $landCertificate->update($request->all());

        return redirect()->route('land_certificate.index')->with('success', 'Data Sertifikat Tanah berhasil diupdate');
    }

    public function destroy(LandCertificate $landCertificate)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $landCertificate->delete();
        return redirect()->route('land_certificate.index')->with('success', 'Data Sertifikat Tanah berhasil dihapus');
    }
}
