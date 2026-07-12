<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg p-3 h-100">
                <h5 class="mb-3 border-bottom pb-2">Detail Pengaduan</h5>
                <div class="mb-2">
                    <strong>Pelapor:</strong> {{ $complaint->resident->full_name ?? '-' }} (NIK: {{ $complaint->resident->national_id ?? '-' }})
                </div>
                <div class="mb-2">
                    <strong>Waktu Lapor:</strong> {{ $complaint->created_at->format('d M Y, H:i') }}
                </div>
                <div class="mb-2">
                    <strong>Judul:</strong> <br> {{ $complaint->title }}
                </div>
                <div class="mb-2">
                    <strong>Deskripsi:</strong> <br>
                    <p class="mt-1 text-muted">{{ $complaint->description }}</p>
                </div>
                @if($complaint->photo_url)
                <div class="mb-2">
                    <strong>Bukti Foto:</strong> <br>
                    <img src="{{ $complaint->photo_url }}" alt="Bukti Pengaduan" class="img-fluid mt-2 rounded" style="max-height: 250px;">
                </div>
                @endif
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-lg p-3 h-100">
                <h5 class="mb-3 border-bottom pb-2">Tindak Lanjut</h5>
                <form action="{{ route('complaint.update', $complaint) }}" method="post" class="form">
                    @csrf
                    @method('put')
                    
                    <div class="mb-3">
                        <label for="status" class="form-label required">Update Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="open" @selected(old('status', $complaint->status) == 'open')>Belum Ditangani (Open)</option>
                            <option value="in_progress" @selected(old('status', $complaint->status) == 'in_progress')>Sedang Ditangani (In Progress)</option>
                            <option value="resolved" @selected(old('status', $complaint->status) == 'resolved')>Selesai (Resolved)</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info">
                        <strong>Info:</strong> Menyimpan perubahan ini akan mencatat Anda (<strong>{{ auth()->user()->name }}</strong>) sebagai petugas yang menangani pengaduan ini.
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('complaint.index') }}" class="btn btn-warning me-1">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Tindak Lanjut</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
