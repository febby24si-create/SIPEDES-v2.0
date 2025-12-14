@extends('layouts.admin.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard SIPEDES')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid dashboard-body">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 dashboard-header">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </h1>
    </div>

    <!-- Content Row -->
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

        <!-- Perangkat Desa Card - ✅ TAMBAH INI -->
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
