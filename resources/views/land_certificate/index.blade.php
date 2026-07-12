<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Daftar Sertifikat Tanah</h5>
            <a href="{{ route('land_certificate.create') }}" class="btn btn-primary">Tambah Data</a>
        </div>

        <form action="{{ route('land_certificate.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan No. Sertifikat, Nama Pemilik, atau NIK..." value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
                @if(request()->has('search') && request('search') != '')
                    <a href="{{ route('land_certificate.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">No. Sertifikat</th>
                        <th scope="col">Pemilik (NIK)</th>
                        <th scope="col">Luas Tanah (m²)</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($landCertificates as $certificate)
                        <tr>
                            <td>{{ $loop->iteration + $landCertificates->firstItem() - 1 }}</td>
                            <td>{{ $certificate->certificate_number }}</td>
                            <td>{{ $certificate->owner->full_name }} <br><small class="text-muted">{{ $certificate->owner->national_id }}</small></td>
                            <td>{{ $certificate->area_size }}</td>
                            <td>{{ $certificate->location }}</td>
                            <td>
                                <a href="{{ route('land_certificate.edit', $certificate) }}" class="btn btn-warning btn-sm">
                                    <i class='bx bx-edit-alt'></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-route="{{ route('land_certificate.destroy', $certificate) }}">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $landCertificates->links() }}
        </div>
    </div>

    @push('modals')
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" id="form-delete">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus data sertifikat tanah ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            $('.btn-delete').on('click', function() {
                $('#form-delete').attr('action', $(this).data('route'))
            })
        </script>
    @endpush

</x-app>
