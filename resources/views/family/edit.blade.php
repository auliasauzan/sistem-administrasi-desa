<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">

        <form action="{{ route('family.update', $family) }}" method="post" class="form">
            @csrf
            @method('put')

            <div class="row g-3 mb-3">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="family_card_number" class="form-label required">Nomor Kartu Keluarga (NKK)</label>
                        <input class="form-control @error('family_card_number') is-invalid  @enderror" type="text" id="family_card_number"
                            name="family_card_number" required value="{{ old('family_card_number', $family->family_card_number) }}">
                        @error('family_card_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label required">Alamat Lengkap</label>
                        <input class="form-control @error('address') is-invalid  @enderror" type="text" id="address"
                            name="address" required value="{{ old('address', $family->address) }}">
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="neighborhood" class="form-label required">RT/RW</label>
                        <input class="form-control @error('neighborhood') is-invalid  @enderror" type="text" id="neighborhood"
                            name="neighborhood" required value="{{ old('neighborhood', $family->neighborhood) }}" placeholder="Contoh: 001/005">
                        @error('neighborhood')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('family.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>

    </div>

</x-app>
