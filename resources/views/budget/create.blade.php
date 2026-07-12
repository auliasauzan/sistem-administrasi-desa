<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('budget.store') }}" method="post" class="form">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="budget_type" class="form-label required">Jenis Anggaran</label>
                    <select class="form-select @error('budget_type') is-invalid @enderror" id="budget_type" name="budget_type" required>
                        <option value="income" @selected(old('budget_type') == 'income')>Pemasukan</option>
                        <option value="expense" @selected(old('budget_type') == 'expense')>Pengeluaran</option>
                    </select>
                    @error('budget_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="year" class="form-label required">Tahun Anggaran</label>
                    <input class="form-control @error('year') is-invalid @enderror" type="number" id="year" name="year" required value="{{ old('year', date('Y')) }}" min="2000">
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label required">Kategori</label>
                <input class="form-control @error('category') is-invalid @enderror" type="text" id="category" name="category" required value="{{ old('category') }}" placeholder="Contoh: Dana Desa, Operasional, Pembangunan">
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label required">Nominal (Rp)</label>
                <input class="form-control @error('amount') is-invalid @enderror" type="number" id="amount" name="amount" required value="{{ old('amount') }}" step="0.01" min="0">
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label required">Deskripsi Rincian</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required placeholder="Jelaskan detail peruntukan atau sumber dana ini...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('budget.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Anggaran</button>
            </div>
        </form>
    </div>
</x-app>
