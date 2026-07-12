<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Pengajuan Surat</h5>
            @if(auth()->user()->role === 'Warga')
                <a href="{{ route('letter.create') }}" class="btn btn-primary">Buat Pengajuan Baru</a>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pemohon</th>
                        <th scope="col">Jenis Surat</th>
                        <th scope="col">Tanggal Pengajuan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Verifikator</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($letters as $letter)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $letter->resident->full_name }}</td>
                            <td>{{ $letter->letterType->name }}</td>
                            <td>{{ $letter->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($letter->status === 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($letter->status === 'rejected')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning">Menunggu</span>
                                @endif
                            </td>
                            <td>{{ $letter->approver->user->name ?? '-' }}</td>
                            <td>
                                @if(auth()->user()->role !== 'Warga')
                                    <a href="{{ route('letter.edit', $letter) }}" class="btn btn-info btn-sm">
                                        <i class='bx bx-check-shield'></i> Verifikasi
                                    </a>
                                @endif
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-route="{{ route('letter.destroy', $letter) }}">
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
                            Apakah anda yakin ingin menghapus data pengajuan surat ini?
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
