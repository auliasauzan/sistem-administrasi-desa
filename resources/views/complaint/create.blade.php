<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('complaint.store') }}" method="post" class="form">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label required">Judul Pengaduan</label>
                <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" required value="{{ old('title') }}" placeholder="Contoh: Lampu Jalan Padam di RT 01">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label required">Deskripsi / Detail Keluhan</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required placeholder="Ceritakan detail keluhan Anda...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="photo_url" class="form-label">Bukti Foto (URL/Link Opsional)</label>
                <input class="form-control @error('photo_url') is-invalid @enderror" type="url" id="photo_url" name="photo_url" value="{{ old('photo_url') }}" placeholder="https://contoh-gambar.com/foto.jpg">
                <small class="text-muted">Masukkan link URL foto jika ada bukti (opsional).</small>
                @error('photo_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('complaint.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
            </div>
        </form>
    </div>
</x-app>
