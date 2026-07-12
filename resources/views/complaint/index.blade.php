<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Daftar Pengaduan</h5>
            @if(auth()->user()->role === 'Warga')
                <a href="{{ route('complaint.create') }}" class="btn btn-primary">Buat Pengaduan</a>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pelapor</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ditangani Oleh</th>
                        <th scope="col">Tanggal Lapor</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($complaints as $complaint)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $complaint->resident->full_name ?? '-' }}</td>
                            <td>{{ $complaint->title }}</td>
                            <td>
                                @if($complaint->status === 'resolved')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($complaint->status === 'in_progress')
                                    <span class="badge bg-warning text-dark">Sedang Ditangani</span>
                                @else
                                    <span class="badge bg-danger">Belum Ditangani (Open)</span>
                                @endif
                            </td>
                            <td>{{ $complaint->handler->user->name ?? '-' }}</td>
                            <td>{{ $complaint->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                @if(auth()->user()->role !== 'Warga')
                                    <a href="{{ route('complaint.edit', $complaint) }}" class="btn btn-info btn-sm">
                                        <i class='bx bx-check-shield'></i> Tangani
                                    </a>
                                @endif
                                
                                @if(auth()->user()->role !== 'Warga' || (auth()->user()->role === 'Warga' && $complaint->status === 'open'))
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-route="{{ route('complaint.destroy', $complaint) }}">
                                    <i class='bx bx-trash'></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada pengaduan</td>
                        </tr>
                    @endforelse
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
                            Apakah anda yakin ingin menghapus data pengaduan ini?
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
