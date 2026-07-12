<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VillageAsset;

class VillageAssetController extends Controller
{
    public function __construct()
    {
        // Only non-warga can access this controller. In Laravel 11, best handled in the route or methods.
        // We will abort in methods to be consistent with previous modules.
    }

    public function index()
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $assets = VillageAsset::latest()->get();
        $title = 'Inventaris Aset Desa';
        return view('village_asset.index', compact('assets', 'title'));
    }

    public function create()
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $title = 'Tambah Aset';
        return view('village_asset.create', compact('title'));
    }

    public function store(Request $request)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'asset_code' => 'required|string|unique:village_assets,asset_code',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'condition' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'acquisition_date' => 'required|date',
            'location' => 'required|string|max:255',
        ], [
            'asset_code.required' => 'Kode aset wajib diisi',
            'asset_code.unique' => 'Kode aset sudah terdaftar',
            'name.required' => 'Nama aset wajib diisi',
            'quantity.required' => 'Jumlah aset wajib diisi',
            'quantity.integer' => 'Jumlah aset harus berupa angka',
            'condition.required' => 'Kondisi wajib dipilih',
            'acquisition_date.required' => 'Tanggal perolehan wajib diisi',
            'location.required' => 'Lokasi wajib diisi',
        ]);

        VillageAsset::create($request->all());

        return redirect()->route('village_asset.index')->with('success', 'Data aset berhasil ditambahkan');
    }

    public function edit(VillageAsset $villageAsset)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $title = 'Edit Aset';
        return view('village_asset.edit', compact('villageAsset', 'title'));
    }

    public function update(Request $request, VillageAsset $villageAsset)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'asset_code' => 'required|string|unique:village_assets,asset_code,' . $villageAsset->id,
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'condition' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'acquisition_date' => 'required|date',
            'location' => 'required|string|max:255',
        ], [
            'asset_code.required' => 'Kode aset wajib diisi',
            'asset_code.unique' => 'Kode aset sudah terdaftar',
            'name.required' => 'Nama aset wajib diisi',
            'quantity.required' => 'Jumlah aset wajib diisi',
            'quantity.integer' => 'Jumlah aset harus berupa angka',
            'condition.required' => 'Kondisi wajib dipilih',
            'acquisition_date.required' => 'Tanggal perolehan wajib diisi',
            'location.required' => 'Lokasi wajib diisi',
        ]);

        $villageAsset->update($request->all());

        return redirect()->route('village_asset.index')->with('success', 'Data aset berhasil diubah');
    }

    public function destroy(VillageAsset $villageAsset)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $villageAsset->delete();

        return redirect()->route('village_asset.index')->with('success', 'Data aset berhasil dihapus');
    }
}
