<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Mading Digital Desa</h4>
        @if(auth()->user()->role !== 'Warga')
            <a href="{{ route('announcement.create') }}" class="btn btn-primary">
                <i class='bx bx-plus'></i> Buat Pengumuman
            </a>
        @endif
    </div>

    <div class="row">
        @forelse ($announcements as $announcement)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0 bg-white" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-header bg-primary text-white border-0 py-3">
                        <h5 class="card-title mb-0 text-truncate" title="{{ $announcement->title }}">
                            {{ $announcement->title }}
                        </h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3 text-muted small d-flex align-items-center gap-2">
                            <span><i class='bx bx-calendar'></i> {{ $announcement->published_at->format('d M Y, H:i') }}</span>
                            <span>|</span>
                            <span><i class='bx bx-user'></i> {{ $announcement->author->user->name ?? 'Admin' }} ({{ $announcement->author->position ?? 'Perangkat Desa' }})</span>
                        </div>
                        
                        <div class="card-text flex-grow-1" style="white-space: pre-line;">
                            {{ \Illuminate\Support\Str::limit($announcement->content, 150) }}
                        </div>
                        
                        @if(strlen($announcement->content) > 150)
                            <button type="button" class="btn btn-link p-0 text-decoration-none mt-2 text-start" data-bs-toggle="modal" data-bs-target="#readMoreModal{{ $announcement->id }}">
                                Baca Selengkapnya...
                            </button>

                            <!-- Read More Modal -->
                            <div class="modal fade" id="readMoreModal{{ $announcement->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">{{ $announcement->title }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-4 text-muted small border-bottom pb-2">
                                                <span><i class='bx bx-calendar'></i> {{ $announcement->published_at->format('d M Y, H:i') }}</span>
                                                <span class="mx-2">|</span>
                                                <span><i class='bx bx-user'></i> {{ $announcement->author->user->name ?? 'Admin' }} ({{ $announcement->author->position ?? 'Perangkat Desa' }})</span>
                                            </div>
                                            <div style="white-space: pre-line; line-height: 1.6;">
                                                {{ $announcement->content }}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if(auth()->user()->role !== 'Warga')
                        <div class="card-footer bg-light border-0 d-flex justify-content-end gap-2 py-3">
                            <a href="{{ route('announcement.edit', $announcement) }}" class="btn btn-warning btn-sm">
                                <i class='bx bx-edit'></i> Edit
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-route="{{ route('announcement.destroy', $announcement) }}">
                                <i class='bx bx-trash'></i> Hapus
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center shadow-sm">
                    <i class='bx bx-info-circle fs-4 mb-2 d-block'></i>
                    Belum ada pengumuman desa saat ini.
                </div>
            </div>
        @endforelse
    </div>

    @if(auth()->user()->role !== 'Warga')
    @push('modals')
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pengumuman</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" id="form-delete">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus pengumuman ini?
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
            $(document).on('click', '.btn-delete', function() {
                $('#form-delete').attr('action', $(this).data('route'))
            })
        </script>
    @endpush
    @endif

</x-app>
