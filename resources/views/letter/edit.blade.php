<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3 mb-4">
        <h5 class="mb-3">Detail Pemohon</h5>
        <table class="table table-bordered">
            <tr>
                <th width="30%">Nama Lengkap</th>
                <td>{{ $letter->resident->full_name }}</td>
            </tr>
            <tr>
                <th>NIK</th>
                <td>{{ $letter->resident->national_id }}</td>
            </tr>
            <tr>
                <th>NKK (Kartu Keluarga)</th>
                <td>{{ $letter->resident->family->family_card_number }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $letter->resident->gender }}</td>
            </tr>
            <tr>
                <th>Pekerjaan</th>
                <td>{{ $letter->resident->occupation }}</td>
            </tr>
        </table>
    </div>

    <div class="card shadow-lg p-3">
        <h5 class="mb-3">Detail Pengajuan Surat</h5>
        <table class="table table-bordered mb-4">
            <tr>
                <th width="30%">Jenis Surat</th>
                <td><strong>{{ $letter->letterType->name }}</strong></td>
            </tr>
            <tr>
                <th>Tanggal Pengajuan</th>
                <td>{{ $letter->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Persyaratan Surat</th>
                <td>{{ $letter->letterType->requirements ?? '-' }}</td>
            </tr>
        </table>

        <form action="{{ route('letter.update', $letter) }}" method="post" class="form">
            @csrf
            @method('put')
            
            <div class="mb-3">
                <label for="status" class="form-label required">Status Verifikasi</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="approved" @selected(old('status', $letter->status) == 'approved')>Setujui</option>
                    <option value="rejected" @selected(old('status', $letter->status) == 'rejected')>Tolak</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Catatan (Opsional)</label>
                <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3" placeholder="Tambahkan catatan untuk pemohon...">{{ old('note', $letter->note) }}</textarea>
                @error('note')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('letter.index') }}" class="btn btn-warning me-1">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Verifikasi</button>
            </div>
        </form>
    </div>
</x-app>
