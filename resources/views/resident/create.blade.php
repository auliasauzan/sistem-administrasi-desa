<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">

        <form action="{{ route('resident.store') }}" method="post" class="form">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="family_id" class="form-label required">Kartu Keluarga (NKK)</label>
                        <select class="form-select select2-default @error('family_id') is-invalid @enderror" id="family_id" name="family_id" required>
                            <option value="">Pilih NKK - Kepala Keluarga / Alamat</option>
                            @foreach($families as $family)
                                <option value="{{ $family->id }}" @selected(old('family_id') == $family->id)>
                                    {{ $family->family_card_number }} - {{ $family->address }}
                                </option>
                            @endforeach
                        </select>
                        @error('family_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="national_id" class="form-label required">Nomor Induk Kependudukan (NIK)</label>
                        <input class="form-control @error('national_id') is-invalid  @enderror" type="text" id="national_id"
                            name="national_id" required value="{{ old('national_id') }}">
                        @error('national_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="full_name" class="form-label required">Nama Lengkap</label>
                        <input class="form-control @error('full_name') is-invalid  @enderror" type="text" id="full_name"
                            name="full_name" required value="{{ old('full_name') }}">
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="birth_date" class="form-label required">Tanggal Lahir</label>
                        <input class="form-control @error('birth_date') is-invalid  @enderror" type="date" id="birth_date"
                            name="birth_date" required value="{{ old('birth_date') }}">
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="gender" class="form-label required">Jenis Kelamin</label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" @selected(old('gender') == 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('gender') == 'Perempuan')>Perempuan</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="religion" class="form-label required">Agama</label>
                        <select class="form-select @error('religion') is-invalid @enderror" id="religion" name="religion" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam" @selected(old('religion') == 'Islam')>Islam</option>
                            <option value="Kristen" @selected(old('religion') == 'Kristen')>Kristen</option>
                            <option value="Katolik" @selected(old('religion') == 'Katolik')>Katolik</option>
                            <option value="Hindu" @selected(old('religion') == 'Hindu')>Hindu</option>
                            <option value="Buddha" @selected(old('religion') == 'Buddha')>Buddha</option>
                            <option value="Konghucu" @selected(old('religion') == 'Konghucu')>Konghucu</option>
                        </select>
                        @error('religion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="occupation" class="form-label required">Pekerjaan</label>
                        <input class="form-control @error('occupation') is-invalid  @enderror" type="text" id="occupation"
                            name="occupation" required value="{{ old('occupation') }}">
                        @error('occupation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('resident.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>

    </div>

</x-app>
