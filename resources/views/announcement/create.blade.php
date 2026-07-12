<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('announcement.store') }}" method="post" class="form">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label required">Judul Pengumuman</label>
                <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" required value="{{ old('title') }}" placeholder="Contoh: Jadwal Kerja Bakti Minggu Ini">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="published_at" class="form-label required">Tanggal Publikasi</label>
                <input class="form-control @error('published_at') is-invalid @enderror" type="datetime-local" id="published_at" name="published_at" required value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                @error('published_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label required">Isi Pengumuman</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="8" required placeholder="Tuliskan isi pengumuman secara detail...">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('announcement.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Terbitkan Pengumuman</button>
            </div>
        </form>
    </div>
</x-app>
