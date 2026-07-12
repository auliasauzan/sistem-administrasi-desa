<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Welcome Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="fw-bold mb-3">
                        <i class='bx bx-smile text-primary me-2'></i>
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-muted mb-0">
                        Anda login sebagai <span class="badge bg-primary">{{ Auth::user()->role }}</span>
                    </p>
                    <p class="text-muted mt-2">
                        <i class='bx bx-time-five me-1'></i>
                        {{ now()->isoFormat('dddd, D MMMM YYYY - HH:mm') }}
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('niceadmin/img/noprofil.png') }}"
                        alt="Avatar" class="img-fluid rounded-circle border border-3 border-primary"
                        style="max-width: 150px;">
                </div>
            </div>
        </div>
    </div>

    <!-- New Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 small">Total Penduduk</p>
                            <h2 class="fw-bold mb-0">{{ $totalPenduduk }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class='bx bx-group fs-2 text-primary'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 small">Surat Bulan Ini</p>
                            <h2 class="fw-bold mb-0">{{ $suratBulanIni }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class='bx bx-envelope fs-2 text-success'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 small">Pengaduan Aktif</p>
                            <h2 class="fw-bold mb-0">{{ $pengaduanAktif }}</h2>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                            <i class='bx bx-message-error fs-2 text-danger'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Populasi Penduduk per Wilayah</h6>
                </div>
                <div class="card-body">
                    <canvas id="rtChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Status Surat Pengantar</h6>
                </div>
                <div class="card-body">
                    <canvas id="letterChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Realisasi vs Anggaran per Kategori (Mock)</h6>
                </div>
                <div class="card-body">
                    <canvas id="budgetChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Status Pengaduan Warga</h6>
                </div>
                <div class="card-body">
                    <canvas id="complaintChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>


    @push('modals')
    @endpush

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Chart 1: Penduduk per RT (Bar Chart)
            const ctxRt = document.getElementById('rtChart').getContext('2d');
            new Chart(ctxRt, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartRtLabels) !!},
                    datasets: [{
                        label: 'Jumlah Penduduk',
                        data: {!! json_encode($chartRtData) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                }
            });

            // Chart 2: Status Surat (Pie Chart)
            const ctxLetter = document.getElementById('letterChart').getContext('2d');
            new Chart(ctxLetter, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($chartLetterLabels) !!},
                    datasets: [{
                        data: {!! json_encode($chartLetterData) !!},
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.6)', // Menunggu (Yellow)
                            'rgba(54, 162, 235, 0.6)', // Diproses (Blue)
                            'rgba(75, 192, 192, 0.6)', // Selesai (Green)
                            'rgba(255, 99, 132, 0.6)'  // Ditolak (Red)
                        ]
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // Chart 3: Realisasi vs Anggaran (Bar Chart Grouped)
            const ctxBudget = document.getElementById('budgetChart').getContext('2d');
            new Chart(ctxBudget, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartBudgetLabels) !!},
                    datasets: [
                        {
                            label: 'Anggaran (Rp)',
                            data: {!! json_encode($chartBudgetAnggaran) !!},
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Realisasi (Rp) *Mock',
                            data: {!! json_encode($chartBudgetRealisasi) !!},
                            backgroundColor: 'rgba(153, 102, 255, 0.6)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Chart 4: Status Pengaduan (Pie Chart)
            const ctxComplaint = document.getElementById('complaintChart').getContext('2d');
            new Chart(ctxComplaint, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($chartComplaintLabels) !!},
                    datasets: [{
                        data: {!! json_encode($chartComplaintData) !!},
                        backgroundColor: [
                            'rgba(255, 159, 64, 0.6)', // Orange
                            'rgba(54, 162, 235, 0.6)', // Blue
                            'rgba(75, 192, 192, 0.6)', // Green
                            'rgba(255, 99, 132, 0.6)'  // Red
                        ]
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        });
    </script>
    @endpush

</x-app>
