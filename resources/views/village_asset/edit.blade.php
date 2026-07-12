<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('village_asset.update', $villageAsset) }}" method="post" class="form">
            @csrf
            @method('put')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="asset_code" class="form-label required">Kode Aset</label>
                    <input class="form-control @error('asset_code') is-invalid @enderror" type="text" id="asset_code" name="asset_code" required value="{{ old('asset_code', $villageAsset->asset_code) }}">
                    @error('asset_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label required">Nama Barang/Aset</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" required value="{{ old('name', $villageAsset->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="quantity" class="form-label required">Jumlah</label>
                    <input class="form-control @error('quantity') is-invalid @enderror" type="number" id="quantity" name="quantity" required value="{{ old('quantity', $villageAsset->quantity) }}" min="1">
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="condition" class="form-label required">Kondisi</label>
                    <select class="form-select @error('condition') is-invalid @enderror" id="condition" name="condition" required>
                        <option value="Baik" @selected(old('condition', $villageAsset->condition) == 'Baik')>Baik</option>
                        <option value="Rusak Ringan" @selected(old('condition', $villageAsset->condition) == 'Rusak Ringan')>Rusak Ringan</option>
                        <option value="Rusak Berat" @selected(old('condition', $villageAsset->condition) == 'Rusak Berat')>Rusak Berat</option>
                    </select>
                    @error('condition')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="acquisition_date" class="form-label required">Tgl. Perolehan</label>
                    <input class="form-control @error('acquisition_date') is-invalid @enderror" type="date" id="acquisition_date" name="acquisition_date" required value="{{ old('acquisition_date', $villageAsset->acquisition_date->format('Y-m-d')) }}">
                    @error('acquisition_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label required">Lokasi Penyimpanan / Keberadaan</label>
                    <input class="form-control @error('location') is-invalid @enderror" type="text" id="location" name="location" required value="{{ old('location', $villageAsset->location) }}">
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('village_asset.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app>
