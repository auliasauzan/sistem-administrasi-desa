<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm bg-success text-white">
                <div class="card-body">
                    <h6 class="card-title"><i class='bx bx-trending-up'></i> Total Pemasukan</h6>
                    <h3 class="mb-0">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm bg-danger text-white">
                <div class="card-body">
                    <h6 class="card-title"><i class='bx bx-trending-down'></i> Total Pengeluaran</h6>
                    <h3 class="mb-0">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm bg-primary text-white">
                <div class="card-body">
                    <h6 class="card-title"><i class='bx bx-wallet'></i> Saldo Anggaran</h6>
                    <h3 class="mb-0">Rp {{ number_format($balance, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-lg p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center gap-2">
                <h5 class="card-title mb-0">Rincian Anggaran Tahun</h5>
                <form action="{{ route('budget.index') }}" method="GET" class="d-flex">
                    <select name="year" class="form-select form-select-sm" onchange="this.form.submit()">
                        @foreach($availableYears as $y)
                            <option value="{{ $y }}" @selected($year == $y)>{{ $y }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            
            @if(auth()->user()->role !== 'Warga')
                <a href="{{ route('budget.create') }}" class="btn btn-primary">Tambah Anggaran</a>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Nominal (Rp)</th>
                        @if(auth()->user()->role !== 'Warga')
                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($budgets as $budget)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($budget->budget_type === 'income')
                                    <span class="badge bg-success">Pemasukan</span>
                                @else
                                    <span class="badge bg-danger">Pengeluaran</span>
                                @endif
                            </td>
                            <td>{{ $budget->category }}</td>
                            <td>{{ $budget->description }}</td>
                            <td class="text-end">{{ number_format($budget->amount, 0, ',', '.') }}</td>
                            @if(auth()->user()->role !== 'Warga')
                            <td>
                                <a href="{{ route('budget.edit', $budget) }}" class="btn btn-warning btn-sm">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-route="{{ route('budget.destroy', $budget) }}">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role !== 'Warga' ? '6' : '5' }}" class="text-center">Belum ada data anggaran untuk tahun {{ $year }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if(auth()->user()->role !== 'Warga')
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
                            Apakah anda yakin ingin menghapus data anggaran ini?
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
    @endif

</x-app>
