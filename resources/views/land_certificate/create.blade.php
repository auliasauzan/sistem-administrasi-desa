<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('land_certificate.store') }}" method="post" class="form">
            @csrf
            
            <div class="mb-3">
                <label for="owner_id" class="form-label required">Pemilik (Penduduk)</label>
                <select class="form-select select2-default @error('owner_id') is-invalid @enderror" id="owner_id" name="owner_id" required>
                    <option value="">Pilih Pemilik</option>
                    @foreach($residents as $resident)
                        <option value="{{ $resident->id }}" @selected(old('owner_id') == $resident->id)>
                            {{ $resident->full_name }} (NIK: {{ $resident->national_id }})
                        </option>
                    @endforeach
                </select>
                @error('owner_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="certificate_number" class="form-label required">Nomor Sertifikat</label>
                <input class="form-control @error('certificate_number') is-invalid @enderror" type="text" id="certificate_number" name="certificate_number" required value="{{ old('certificate_number') }}" placeholder="Contoh: 10.15.22.05.1.12345">
                @error('certificate_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="area_size" class="form-label required">Luas Tanah (m²)</label>
                <input class="form-control @error('area_size') is-invalid @enderror" type="number" step="0.01" id="area_size" name="area_size" required value="{{ old('area_size') }}" placeholder="Contoh: 150.5">
                @error('area_size')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location" class="form-label required">Lokasi Tanah</label>
                <textarea class="form-control @error('location') is-invalid @enderror" id="location" name="location" rows="3" required placeholder="Contoh: Jl. Merdeka No. 10, RT 01/RW 02">{{ old('location') }}</textarea>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('land_certificate.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
