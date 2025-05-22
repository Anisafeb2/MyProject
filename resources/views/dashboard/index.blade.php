@extends('layouts.app')

@section('title', 'Dashboard Perpustakaan')

@section('content')
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="#">LiteraNet</a>

        <div class="d-flex align-items-center ms-auto">
            <!-- Search -->
            <form class="d-none d-md-flex me-3">
                <input class="form-control form-control-sm" type="search" placeholder="Cari buku..." aria-label="Search">
            </form>

            <!-- Notifikasi -->
            <button class="btn position-relative me-3">
                <i class="bi bi-bell fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                </span>
            </button>

            <!-- Dropdown User -->
            <div class="dropdown">
                <a class="btn btn-outline-secondary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profil Saya</a></li>
                    <li><a class="dropdown-item" href="#">Ganti Password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- DASHBOARD CONTENT -->
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-center text-primary">Dashboard Manajemen Perpustakaan</h2>

    <div class="row g-4">
        <!-- Total Buku -->
        <div class="col-md-3">
            <a href="{{ route('databuku.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow rounded-4 hover-card bg-gradient-primary text-white">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="icon-circle bg-white text-primary">
                            <i class="bi bi-journal-bookmark-fill fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Buku</h6>
                            <h4 class="mb-0 fw-bold">{{ $totalBuku }}</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Anggota -->
        <div class="col-md-3">
            <a href="{{ route('dataanggota.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow rounded-4 hover-card bg-gradient-success text-white">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="icon-circle bg-white text-success">
                            <i class="bi bi-people-fill fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Anggota</h6>
                            <h4 class="mb-0 fw-bold">{{ $totalAnggota }}</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Peminjaman -->
        <div class="col-md-3">
            <a href="{{ route('peminjaman.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow rounded-4 hover-card bg-gradient-warning text-dark">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="icon-circle bg-white text-warning">
                            <i class="bi bi-arrow-left-right fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Peminjaman</h6>
                            <h4 class="mb-0 fw-bold">{{ $totalPeminjaman }}</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Peminjaman Aktif -->
        <div class="col-md-3">
            <a href="{{ route('peminjaman.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow rounded-4 hover-card bg-gradient-danger text-white">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="icon-circle bg-white text-danger">
                            <i class="bi bi-clock-history fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Peminjaman Aktif</h6>
                            <h4 class="mb-0 fw-bold">{{ $peminjamanAktif }}</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Grafik -->
    <div class="card mt-5 shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Statistik Peminjaman per Bulan</h5>
            <canvas id="chartPeminjaman"></canvas>
        </div>
    </div>
</div>

<!-- STYLE -->
<style>
    .hover-card {
        transition: all 0.3s ease-in-out;
    }

    .hover-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #1cc88a, #12875b);
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #f6c23e, #dda20a);
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #e74a3b, #be2617);
    }


</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script Chart  -->
<script>
    const ctx = document.getElementById('chartPeminjaman').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Peminjaman',
                data: [12, 19, 15, 22, 18, 25],
                backgroundColor: '#4e73df'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { labels: { color: '#333' } }
            },
            scales: {
                x: { ticks: { color: '#333' } },
                y: { ticks: { color: '#333' } }
            }
        }
    });

    // Toggle Dark Mode
    document.getElementById('darkModeToggle').addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        const dark = document.body.classList.contains('dark-mode');

        // Update chart colors
        chart.options.plugins.legend.labels.color = dark ? '#e0e0e0' : '#333';
        chart.options.scales.x.ticks.color = dark ? '#e0e0e0' : '#333';
        chart.options.scales.y.ticks.color = dark ? '#e0e0e0' : '#333';
        chart.update();
    });
</script>
@endsection
