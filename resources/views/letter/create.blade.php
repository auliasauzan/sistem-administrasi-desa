<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('letter.store') }}" method="post" class="form">
            @csrf
            
            <div class="mb-3">
                <label for="resident_id" class="form-label required">Pemohon (Anggota Keluarga)</label>
                <select class="form-select @error('resident_id') is-invalid @enderror" id="resident_id" name="resident_id" required>
                    <option value="">Pilih Anggota Keluarga</option>
                    @foreach($residents as $resident)
                        <option value="{{ $resident->id }}" @selected(old('resident_id') == $resident->id)>
                            {{ $resident->full_name }} (NIK: {{ $resident->national_id }})
                        </option>
                    @endforeach
                </select>
                @error('resident_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="letter_type_id" class="form-label required">Jenis Surat</label>
                <select class="form-select @error('letter_type_id') is-invalid @enderror" id="letter_type_id" name="letter_type_id" required>
                    <option value="">Pilih Jenis Surat</option>
                    @foreach($letterTypes as $type)
                        <option value="{{ $type->id }}" @selected(old('letter_type_id') == $type->id)>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('letter_type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="alert alert-info mt-4" id="requirements_box" style="display: none;">
                <strong>Persyaratan Dokumen:</strong>
                <p id="requirements_text" class="mb-0"></p>
                <small>Pastikan membawa persyaratan ini saat mengambil surat di kantor desa.</small>
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('letter.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            const letterTypes = @json($letterTypes);
            
            $('#letter_type_id').on('change', function() {
                const id = $(this).val();
                if(id) {
                    const type = letterTypes.find(t => t.id == id);
                    if(type && type.requirements) {
                        $('#requirements_text').text(type.requirements);
                        $('#requirements_box').show();
                    } else {
                        $('#requirements_box').hide();
                    }
                } else {
                    $('#requirements_box').hide();
                }
            });
        </script>
    @endpush
</x-app>
