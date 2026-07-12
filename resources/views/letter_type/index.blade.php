<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Daftar Jenis Surat</h5>
            <a href="{{ route('letter_type.create') }}" class="btn btn-primary">Tambah Jenis Surat</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Surat</th>
                        <th scope="col">Persyaratan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($letterTypes as $letterType)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $letterType->name }}</td>
                            <td>{{ $letterType->requirements }}</td>
                            <td>
                                <a href="{{ route('letter_type.edit', $letterType) }}" class="btn btn-warning btn-sm">
                                    <i class='bx bx-edit-alt'></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-route="{{ route('letter_type.destroy', $letterType) }}">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                            Apakah anda yakin ingin menghapus data ini?
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
            $('#data-table').on('click', '.btn-delete', function() {
                $('#form-delete').attr('action', $(this).data('route'))
            })
        </script>
    @endpush

</x-app>
