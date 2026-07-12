<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('letter_type.store') }}" method="post" class="form">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label required">Nama Surat</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="Contoh: Surat Keterangan Tidak Mampu">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="requirements" class="form-label">Persyaratan</label>
                <textarea class="form-control @error('requirements') is-invalid @enderror" id="requirements" name="requirements" rows="4" placeholder="Contoh: Fotokopi KTP, Fotokopi KK">{{ old('requirements') }}</textarea>
                @error('requirements')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('letter_type.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
