@extends('layouts.admin.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard SIPEDES')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 20px;
    }
    
    .card-chart {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card-chart:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid dashboard-body">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 dashboard-header">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </h1>
    </div>

    <!-- Content Row - Stats Cards -->
    <div class="row">
        <!-- Total Warga Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 dashboard-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dashboard-primary text-uppercase mb-1">
                                Total Warga</div>
                            <div class="h5 mb-0 font-weight-bold dashboard-text-primary">{{ $totalWarga }}</div>
                            <div class="mt-2">
                                <span class="badge badge-primary dashboard-badge">
                                    <i class="fas fa-male"></i> Laki-laki: {{ App\Models\Warga::where('jenis_kelamin', 'Laki-laki')->count() }}
                                </span>
                                <span class="badge badge-pink dashboard-badge mt-1">
                                    <i class="fas fa-female"></i> Perempuan: {{ App\Models\Warga::where('jenis_kelamin', 'Perempuan')->count() }}
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x dashboard-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lembaga Desa Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 dashboard-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dashboard-success text-uppercase mb-1">
                                Lembaga Desa</div>
                            <div class="h5 mb-0 font-weight-bold dashboard-text-primary">{{ $totalLembaga }}</div>
                            <div class="mt-2">
                                @php
                                    $totalAnggota = App\Models\AnggotaLembaga::count();
                                @endphp
                                <span class="badge badge-success dashboard-badge">
                                    <i class="fas fa-users"></i> Total Anggota: {{ $totalAnggota }}
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x dashboard-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Perangkat Desa Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 dashboard-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dashboard-warning text-uppercase mb-1">
                                Perangkat Desa</div>
                            <div class="h5 mb-0 font-weight-bold dashboard-text-primary">{{ $totalPerangkat }}</div>
                            <div class="mt-2">
                                @php
                                    $perangkatAktif = App\Models\PerangkatDesa::where('periode_selesai', null)
                                        ->orWhere('periode_selesai', '>', now())
                                        ->count();
                                @endphp
                                <span class="badge badge-warning dashboard-badge">
                                    <i class="fas fa-user-tie"></i> Aktif: {{ $perangkatAktif }}
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x dashboard-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RW Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 dashboard-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dashboard-info text-uppercase mb-1">
                                RW</div>
                            <div class="h5 mb-0 font-weight-bold dashboard-text-primary">{{ $totalRw }}</div>
                            <div class="mt-2">
                                <span class="badge badge-info dashboard-badge">
                                    <i class="fas fa-map-marker-alt"></i> Wilayah Tercover
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-map-signs fa-2x dashboard-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Grafik Distribusi Jenis Kelamin -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card shadow card-chart">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-chart-pie"></i> Distribusi Jenis Kelamin
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Warga per RW -->
        <div class="col-xl-8 col-lg-6 mb-4">
            <div class="card shadow card-chart">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-chart-bar"></i> Jumlah Warga per RW
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="rwChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Anggota Lembaga -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow card-chart">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #f6c23e 0%, #d4a216 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-chart-line"></i> Anggota per Lembaga
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="lembagaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Distribusi Usia -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow card-chart">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-chart-area"></i> Distribusi Kelompok Usia
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="ageChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-2"></i> Aksi Cepat
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="row g-2">
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('admin.warga.create') }}" class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-center py-2">
                                <i class="fas fa-user-plus me-1"></i> Warga
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('admin.lembaga.create') }}" class="btn btn-success btn-sm w-100 d-flex align-items-center justify-content-center py-2">
                                <i class="fas fa-building me-1"></i> Lembaga
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('admin.perangkat_desa.create') }}" class="btn btn-warning btn-sm w-100 d-flex align-items-center justify-content-center py-2">
                                <i class="fas fa-user-tie me-1"></i> Perangkat
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('admin.user.create') }}" class="btn btn-info btn-sm w-100 d-flex align-items-center justify-content-center py-2">
                                <i class="fas fa-user-plus me-1"></i> User
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('admin.rw.create') }}" class="btn btn-secondary btn-sm w-100 d-flex align-items-center justify-content-center py-2">
                                <i class="fas fa-map-signs me-1"></i> RW
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('admin.rt.create') }}" class="btn btn-dark btn-sm w-100 d-flex align-items-center justify-content-center py-2">
                                <i class="fas fa-map-marker-alt me-1"></i> RT
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Session Info -->
    @auth
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4 user-session-container">
                <div class="card-header py-3 user-session-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-user-clock"></i> Informasi Session
                    </h6>
                </div>

                <div class="card-body p-0">
                    <div class="user-session-grid">
                        <!-- Nama Pengguna -->
                        <div class="user-session-card">
                            <div class="user-session-icon name">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-session-value">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="user-session-label">
                                Nama Pengguna
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="user-session-card">
                            <div class="user-session-icon email">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="user-session-value">
                                {{ Auth::user()->email }}
                            </div>
                            <div class="user-session-label">
                                Email
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="user-session-card">
                            <div class="user-session-icon role">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            <div class="user-session-value">
                                <span class="badge user-session-badge badge-{{ Auth::user()->role == 'admin' ? 'success' : 'info' }}">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>
                            <div class="user-session-label">
                                Role
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Konfigurasi umum untuk semua chart
    Chart.defaults.font.family = "'Poppins', sans-serif";
    Chart.defaults.color = '#858796';
    
    // Data Jenis Kelamin
    @php
        $lakiLaki = App\Models\Warga::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = App\Models\Warga::where('jenis_kelamin', 'Perempuan')->count();
    @endphp

    // Chart 1: Distribusi Jenis Kelamin (Doughnut Chart)
    const genderCtx = document.getElementById('genderChart');
    if (genderCtx) {
        new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $lakiLaki }}, {{ $perempuan }}],
                    backgroundColor: [
                        'rgba(78, 115, 223, 0.8)',
                        'rgba(231, 74, 59, 0.8)'
                    ],
                    borderColor: [
                        'rgba(78, 115, 223, 1)',
                        'rgba(231, 74, 59, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.parsed || 0;
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // Chart 2: Warga per RW (Bar Chart)
    @php
        $rwData = App\Models\Rw::withCount('wargas')->get();
        $rwLabels = $rwData->pluck('nomor_rw_formatted')->toArray();
        $rwCounts = $rwData->pluck('wargas_count')->toArray();
    @endphp

    const rwCtx = document.getElementById('rwChart');
    if (rwCtx) {
        new Chart(rwCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($rwLabels) !!},
                datasets: [{
                    label: 'Jumlah Warga',
                    data: {!! json_encode($rwCounts) !!},
                    backgroundColor: 'rgba(28, 200, 138, 0.8)',
                    borderColor: 'rgba(28, 200, 138, 1)',
                    borderWidth: 2,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        cornerRadius: 8
                    }
                }
            }
        });
    }

    // Chart 3: Anggota per Lembaga (Horizontal Bar)
    @php
        $lembagaData = App\Models\LembagaDesa::withCount('anggotas')->get();
        $lembagaLabels = $lembagaData->pluck('nama_lembaga')->toArray();
        $lembagaCounts = $lembagaData->pluck('anggotas_count')->toArray();
    @endphp

    const lembagaCtx = document.getElementById('lembagaChart');
    if (lembagaCtx) {
        new Chart(lembagaCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($lembagaLabels) !!},
                datasets: [{
                    label: 'Jumlah Anggota',
                    data: {!! json_encode($lembagaCounts) !!},
                    backgroundColor: 'rgba(246, 194, 62, 0.8)',
                    borderColor: 'rgba(246, 194, 62, 1)',
                    borderWidth: 2,
                    borderRadius: 5
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        cornerRadius: 8
                    }
                }
            }
        });
    }

    // Chart 4: Distribusi Kelompok Usia (Line Chart)
    @php
        use Carbon\Carbon;
        
        $anak = App\Models\Warga::whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) < 18')->count();
        $dewasa = App\Models\Warga::whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 18 AND 40')->count();
        $dewasaTua = App\Models\Warga::whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 41 AND 60')->count();
        $lansia = App\Models\Warga::whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) > 60')->count();
    @endphp

    const ageCtx = document.getElementById('ageChart');
    if (ageCtx) {
        new Chart(ageCtx, {
            type: 'line',
            data: {
                labels: ['Anak (0-17)', 'Dewasa (18-40)', 'Dewasa Tua (41-60)', 'Lansia (60+)'],
                datasets: [{
                    label: 'Jumlah Warga',
                    data: [{{ $anak }}, {{ $dewasa }}, {{ $dewasaTua }}, {{ $lansia }}],
                    backgroundColor: 'rgba(54, 185, 204, 0.2)',
                    borderColor: 'rgba(54, 185, 204, 1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(54, 185, 204, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        cornerRadius: 8
                    }
                }
            }
        });
    }
});
</script>
@endsection

