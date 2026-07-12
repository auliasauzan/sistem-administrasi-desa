<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">

        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data" class="form">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label for="avatar" class="form-label">Avatar</label>
                    <input class="form-control @error('avatar') is-invalid  @enderror" type="file" id="upload"
                        name="avatar">
                    @error('avatar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <img src="{{ asset('niceadmin/img/noprofil.png') }}" alt="Avatar" class="w-100 rounded mt-2"
                        id="preview">
                </div>

                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="name" class="form-label required">Nama</label>
                        <input class="form-control @error('name') is-invalid  @enderror" type="text" id="name"
                            name="name" required value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label required">Email</label>
                        <input class="form-control @error('email') is-invalid  @enderror" type="email" id="email"
                            name="email" required value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label required">Password</label>
                        <input class="form-control @error('password') is-invalid  @enderror" type="password"
                            id="password" name="password" required minlength="8">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="passwordconfirm" class="form-label required">Konfirmasi Password</label>
                        <input class="form-control @error('passwordconfirm') is-invalid  @enderror" type="password"
                            id="passwordconfirm" name="passwordconfirm" required data-parsley-equalto="#password">
                        @error('passwordconfirm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label required">Role</label>
                        <select class="form-select select2-default @error('role') is-invalid  @enderror" id="role"
                            name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="Admin Desa" @selected(old('role') == 'Admin Desa')>Admin Desa</option>
                            <option value="Perangkat Desa" @selected(old('role') == 'Perangkat Desa')>Perangkat Desa</option>
                            <option value="Warga" @selected(old('role') == 'Warga')>Warga</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3" id="village_officials_fields" style="display: none;">
                        <div class="mb-3">
                            <label for="position" class="form-label">Jabatan (Khusus Perangkat Desa)</label>
                            <input class="form-control @error('position') is-invalid @enderror" type="text" id="position" name="position" value="{{ old('position') }}">
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">NIP / NRP</label>
                            <input class="form-control @error('employee_id') is-invalid @enderror" type="text" id="employee_id" name="employee_id" value="{{ old('employee_id') }}">
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('user.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>



        </form>

    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                function toggleFields() {
                    const role = $('#role').val();
                    if (role === 'Admin Desa' || role === 'Perangkat Desa') {
                        $('#village_officials_fields').show();
                    } else {
                        $('#village_officials_fields').hide();
                        $('#position').val('');
                        $('#employee_id').val('');
                    }
                }
                
                $('#role').change(toggleFields);
                toggleFields();
            });
        </script>
    @endpush

</x-app>
