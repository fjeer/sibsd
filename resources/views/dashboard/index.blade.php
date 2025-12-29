@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h1>Selamat Datang di Aplikasi Sistem Bank Sampah Digital</h1>
            <p>Pilih menu di sebelah kiri untuk mulai mengelola data.</p>
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 card-nasabah">
                        <div class="card-body">
                            <h5 class="card-title">Nasabah Aktif</h5>
                            <p class="display-6 fw-bold text-primary">{{ $nasabah }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 card-petugas">
                        <div class="card-body">
                            <h5 class="card-title">Petugas Aktif</h5>
                            <p class="display-6 fw-bold text-success">{{ $petugas }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 card-transaksi">
                        <div class="card-body">
                            <h5 class="card-title">Riwayat Transaksi</h5>
                            <p class="display-6 fw-bold text-warning">{{ $transaksi }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-md border-secondary mb-5 bg-light">
                <div class="card-body">
                    <h5 class="card-title">Grafik Setoran Sampah Bulanan</h5>
                    <canvas id="sampahChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const ctx = document.getElementById('sampahChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels)
                , datasets: [{
                    label: 'Total Setoran (Kg)'
                    , data: @json($data)
                    , backgroundColor: 'rgba(54, 162, 235, 0.7)'
                    , borderColor: 'rgba(54, 162, 235, 1)'
                    , borderWidth: 1
                }]
            }
            , options: {
                responsive: true
                , scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>    
@endpush

