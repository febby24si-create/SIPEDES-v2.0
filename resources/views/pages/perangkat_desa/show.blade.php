@extends('layouts.admin.app')

@section('title', 'Detail Perangkat Desa')

@section('content')
<div class="container-fluid">
    <!-- Header dengan breadcrumb -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user-tie text-primary"></i> Detail Perangkat Desa
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.perangkat_desa.index') }}">Perangkat Desa</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.perangkat_desa.edit', $perangkatDesa->id) }}" class="btn btn-warning btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-edit"></i>
                </span>
                <span class="text">Edit Data</span>
            </a>
            <a href="{{ route('admin.perangkat_desa.index') }}" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Foto Profil -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white text-center">Foto Profil</h6>
                </div>
                <div class="card-body text-center">
                    @if($perangkatDesa->foto)
                        <img src="{{ Storage::url($perangkatDesa->foto) }}" alt="Foto" class="img-fluid rounded-circle mb-3 profile-img">
                    @else
                        <img src="{{ asset('assets/img/default-user.png') }}" alt="Default" class="img-fluid rounded-circle mb-3 profile-img">
                    @endif
                    
                    <div class="mt-3">
                        <h4 class="font-weight-bold text-gray-800">{{ $perangkatDesa->warga->nama }}</h4>
                        <p class="text-primary font-weight-bold">{{ $perangkatDesa->jabatan }}</p>
                        
                        <div class="mt-3">
                            @if($perangkatDesa->periode_selesai && $perangkatDesa->periode_selesai < now())
                                <span class="badge badge-danger p-2">Tidak Aktif</span>
                            @else
                                <span class="badge badge-success p-2">Aktif</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Informasi Utama -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-info">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Jabatan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <div class="info-label font-weight-bold text-primary">Nama Lengkap</div>
                                <div class="info-value">{{ $perangkatDesa->warga->nama }}</div>
                            </div>
                            <div class="info-item mb-3">
                                <div class="info-label font-weight-bold text-primary">NIK</div>
                                <div class="info-value">{{ $perangkatDesa->warga->nik }}</div>
                            </div>
                            <div class="info-item mb-3">
                                <div class="info-label font-weight-bold text-primary">Jabatan</div>
                                <div class="info-value">
                                    <span class="badge badge-primary p-2">{{ $perangkatDesa->jabatan }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <div class="info-label font-weight-bold text-primary">NIP</div>
                                <div class="info-value">{{ $perangkatDesa->nip ?? '-' }}</div>
                            </div>
                            <div class="info-item mb-3">
                                <div class="info-label font-weight-bold text-primary">Kontak</div>
                                <div class="info-value">
                                    @if($perangkatDesa->kontak)
                                        <a href="tel:{{ $perangkatDesa->kontak }}" class="text-decoration-none">
                                            <i class="fas fa-phone-alt mr-2 text-success"></i>{{ $perangkatDesa->kontak }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="info-item mb-3">
                                <div class="info-label font-weight-bold text-primary">Periode Jabatan</div>
                                <div class="info-value">
                                    <i class="far fa-calendar-alt mr-2 text-info"></i>
                                    {{ $perangkatDesa->periode_mulai->format('d/m/Y') }}
                                    @if($perangkatDesa->periode_selesai)
                                        - {{ $perangkatDesa->periode_selesai->format('d/m/Y') }}
                                    @else
                                        - Sekarang
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pribadi -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-success">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-user mr-2"></i>Informasi Pribadi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <div class="info-label font-weight-bold text-primary">Tanggal Lahir</div>
                                <div class="info-value">
                                    <i class="far fa-calendar mr-2 text-info"></i>
                                    {{ $perangkatDesa->warga->tgl_lahir->format('d F Y') }} 
                                    <span class="text-muted">({{ $perangkatDesa->warga->tgl_lahir->age }} tahun)</span>
                                </div>
                            </div>
                            <div class="info-item mb-3">
                                <div class="info-label font-weight-bold text-primary">Jenis Kelamin</div>
                                <div class="info-value">
                                    @if($perangkatDesa->warga->jenis_kelamin == 'Laki-laki')
                                        <span class="badge badge-primary p-2">
                                            <i class="fas fa-male mr-1"></i> Laki-laki
                                        </span>
                                    @else
                                        <span class="badge badge-pink p-2">
                                            <i class="fas fa-female mr-1"></i> Perempuan
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <div class="info-label font-weight-bold text-primary">Alamat</div>
                                <div class="info-value">
                                    <i class="fas fa-home mr-2 text-info"></i>
                                    {{ $perangkatDesa->warga->alamat }}
                                </div>
                            </div>
                            <div class="info-item mb-3">
                                <div class="info-label font-weight-bold text-primary">RT/RW</div>
                                <div class="info-value">
                                    @if($perangkatDesa->warga->rt && $perangkatDesa->warga->rw)
                                        <span class="badge badge-secondary p-2">
                                            RT {{ $perangkatDesa->warga->rt->nomor_rt }} / RW {{ $perangkatDesa->warga->rw->nomor_rw }}
                                        </span>
                                    @else
                                        <span class="badge badge-warning p-2">Belum Ditentukan</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-img {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border: 5px solid #e3f2fd;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.info-item {
    padding: 10px 15px;
    border-radius: 8px;
    background-color: #f8f9fc;
    transition: all 0.3s;
}

.info-item:hover {
    background-color: #eef2f7;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}

.info-label {
    font-size: 0.85rem;
    margin-bottom: 5px;
    color: #5a5c69;
}

.info-value {
    font-size: 1rem;
    color: #2e2f33;
}

.card {
    border: none;
    border-radius: 10px;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
}

.badge-pink {
    background-color: #e83e8c;
    color: white;
}

.badge-primary {
    background-color: #000dff;
    color: white;
}

.bg-gradient-info {
    background: linear-gradient(45deg, #17a2b8, #36b9cc) !important;
}

.bg-gradient-success {
    background: linear-gradient(45deg, #1cc88a, #36b9cc) !important;
}

.btn-icon-split {
    border-radius: 8px;
}
</style>
@endsection