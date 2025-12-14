<!-- resources/views/lembaga/show.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Detail Lembaga Desa')
@section('page_title', 'Detail Lembaga')

@section('style')
<style>
    .dashboard-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .dashboard-card:hover {
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.08);
    }

    .dashboard-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px 12px 0 0;
        padding: 1.2rem 1.5rem;
    }

    .dashboard-page-title {
        color: #2d3748;
        font-weight: 700;
        font-size: 1.8rem;
    }

    .security-alert {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        color: white;
        border-left: 4px solid #f44336;
    }

    .security-alert i {
        color: white;
        font-size: 1.5rem;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
    }

    .breadcrumb-item a {
        color: #6c757d;
        transition: color 0.2s;
    }

    .breadcrumb-item a:hover {
        color: #667eea;
        text-decoration: none;
    }

    .detail-table tbody tr {
        border-bottom: 1px solid #e9ecef;
    }

    .detail-table tbody tr:last-child {
        border-bottom: none;
    }

    .detail-table td {
        padding: 1rem 0.5rem;
        vertical-align: top;
    }

    .detail-table td:first-child {
        width: 180px;
        font-weight: 600;
    }

    .text-pre-wrap {
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .dokumen-card {
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }

    .dokumen-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        border-color: #667eea;
    }

    .scrollable-content {
        max-height: 400px;
        overflow-y: auto;
    }

    .badge-level {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 20px;
    }

    .badge-status {
        font-size: 0.75rem;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
    }

    .btn-group-action {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .stats-card {
        border: none;
        border-radius: 12px;
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-3px);
    }

    .stats-card .card-body {
        padding: 1.5rem;
    }

    .border-left-primary {
        border-left: 4px solid #667eea !important;
    }

    .border-left-success {
        border-left: 4px solid #10b981 !important;
    }

    .border-left-warning {
        border-left: 4px solid #f59e0b !important;
    }

    .border-left-info {
        border-left: 4px solid #3b82f6 !important;
    }

    .file-preview-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .file-preview-modal .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-bottom: none;
    }

    .file-preview-modal .modal-body {
        padding: 0;
        background: #f8fafc;
    }

    .preview-container {
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #1a202c;
    }

    .preview-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .preview-document {
        width: 100%;
        height: 100%;
        border: none;
    }

    .preview-video {
        width: 100%;
        max-height: 100%;
        border: none;
    }

    .no-preview {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }

    .no-preview i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .quick-actions .btn {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        text-align: left;
        transition: all 0.3s ease;
        border: none;
    }

    .quick-actions .btn:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .logo-container {
        position: relative;
        display: inline-block;
    }

    .logo-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .logo-container:hover .logo-overlay {
        opacity: 1;
    }

    .btn-view-logo {
        background: rgba(255, 255, 255, 0.9);
        color: #667eea;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-view-logo:hover {
        background: white;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .detail-table td:first-child {
            width: 120px;
        }
        
        .btn-group-action {
            flex-direction: column;
            gap: 5px;
        }
        
        .btn-action {
            width: 32px;
            height: 32px;
        }
        
        .preview-container {
            height: 50vh;
        }
    }

    .table th {
        font-weight: 600;
        color: #4a5568;
        background-color: #f8fafc;
        border-top: none;
    }

    .table td {
        vertical-align: middle;
        color: #4a5568;
    }

    .member-status {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
    }

    .member-status.active {
        background-color: #d1fae5;
        color: #065f46;
    }

    .member-status.inactive {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .member-status.ending {
        background-color: #fef3c7;
        color: #92400e;
    }
    .text-pre-wrap {
    white-space: pre-wrap;
    word-break: break-word;
    overflow-wrap: anywhere;
}

</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Security Alert -->
    <div class="security-alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-shield-alt me-3 fa-lg"></i>
            <div>
                <strong class="d-block">Perhatian Keamanan</strong>
                <span class="small">URL: {{ request()->url() }}</span>
                <div class="mt-1">
                    <small>
                        <i class="fas fa-info-circle me-1"></i>
                        Pastikan URL menggunakan HTTPS untuk keamanan data
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5">
        <div class="mb-3 mb-md-0">
            <h1 class="dashboard-page-title mb-2">
                <i class="fas fa-building me-3"></i>Detail Lembaga Desa
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.lembaga.index') }}" class="text-decoration-none">Lembaga Desa</a>
                    </li>
                    <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">{{ $lembaga->nama_lembaga }}</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.lembaga.edit', $lembaga->id) }}" class="btn btn-warning btn-lg">
                <i class="fas fa-edit me-2"></i>Edit Lembaga
            </a>
            <a href="{{ route('admin.lembaga.index') }}" class="btn btn-secondary btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Left Column - Lembaga Info -->
        <div class="col-lg-8">
            <!-- Basic Information Card -->
            <div class="card dashboard-card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle me-2"></i>Informasi Dasar Lembaga
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-borderless detail-table">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold text-gray-800">Nama Lembaga</td>
                                            <td>
                                                <strong class="text-primary fs-5">{{ $lembaga->nama_lembaga }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-gray-800">Deskripsi</td>
                                            <td>
<div class="text-pre-wrap text-muted bg-light p-3 rounded lh-lg">
    {{ $lembaga->deskripsi }}
</div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-gray-800">Kontak</td>
                                            <td>
                                                @if($lembaga->kontak)
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-info bg-opacity-10 p-2 rounded-circle me-3">
                                                            <i class="fas fa-phone text-info"></i>
                                                        </div>
                                                        <div>
                                                            <span class="text-gray-800 fs-6">{{ $lembaga->kontak }}</span>
                                                            <div class="small text-muted mt-1">
                                                                <i class="fas fa-clock me-1"></i>
                                                                Responsif dalam 24 jam
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">
                                                        <i class="fas fa-ban me-2"></i>Tidak ada kontak
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-gray-800">Dibuat Pada</td>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-calendar-plus text-primary"></i>
                                                    </div>
                                                    <div>
                                                        {{ $lembaga->created_at->format('d F Y') }}
                                                        <div class="small text-muted">
                                                            {{ $lembaga->created_at->format('H:i:s') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-gray-800">Terakhir Diupdate</td>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="fas fa-calendar-check text-success"></i>
                                                    </div>
                                                    <div>
                                                        {{ $lembaga->updated_at->format('d F Y') }}
                                                        <div class="small text-muted">
                                                            {{ $lembaga->updated_at->format('H:i:s') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            @if($lembaga->logo)
                                <div class="logo-container mb-4">
                                    <img src="{{ asset('storage/' . $lembaga->logo) }}" 
                                         alt="Logo {{ $lembaga->nama_lembaga }}" 
                                         class="img-fluid rounded shadow"
                                         style="max-height: 220px; object-fit: contain;"
                                         onerror="this.src='{{ asset('assets/img/default-lembaga.jpg') }}'">
                                    <div class="logo-overlay">
                                        <button type="button" 
                                                class="btn-view-logo" 
                                                onclick="openImageModal('{{ asset('storage/' . $lembaga->logo) }}', 'Logo {{ $lembaga->nama_lembaga }}')">
                                            <i class="fas fa-expand me-2"></i>Lihat Full
                                        </button>
                                    </div>
                                </div>
                                <div class="small text-muted mb-2">
                                    Logo Lembaga
                                </div>
                            @else
                                <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center mb-3" 
                                     style="height: 220px;">
                                    <i class="fas fa-building fa-4x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Belum ada logo</p>
                                </div>
                            @endif
                            <div class="text-muted small bg-light p-2 rounded">
                                <i class="fas fa-fingerprint me-2"></i>
                                ID: <strong>{{ $lembaga->id }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dokumen & Media Card -->
            <div class="card dashboard-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-paperclip me-2"></i>Dokumen & Media
                        <span class="badge bg-light text-dark ms-2">{{ $lembaga->dokumens->count() }}</span>
                    </h6>
                    <a href="{{ route('admin.lembaga.edit', $lembaga->id) }}#dokumen" class="btn btn-sm btn-light">
                        <i class="fas fa-plus me-1"></i>Tambah Dokumen
                    </a>
                </div>
                <div class="card-body">
                    @if($lembaga->dokumens->count() > 0)
                    <div class="row g-3">
                        @foreach($lembaga->dokumens as $dokumen)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="dokumen-card h-100">
                                <div class="card-body p-3">
                                    <!-- File Icon -->
                                    <div class="text-center mb-3">
                                        @if($dokumen->tipe_file == 'image')
                                        <div class="position-relative" style="height: 100px;">
                                            <img src="{{ asset('storage/' . $dokumen->path_file) }}" 
                                                 class="img-fluid rounded h-100 w-100" 
                                                 style="object-fit: cover;"
                                                 alt="{{ $dokumen->nama_file }}"
                                                 onerror="this.src='{{ asset('assets/img/default-doc.jpg') }}'">
                                            <span class="badge bg-success position-absolute top-0 end-0 m-1">
                                                <i class="fas fa-image"></i>
                                            </span>
                                        </div>
                                        @elseif($dokumen->tipe_file == 'document')
                                        <div class="py-3 position-relative" style="height: 100px;">
                                            <div class="h-100 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                            </div>
                                            <span class="badge bg-danger position-absolute top-0 end-0 m-1">
                                                <i class="fas fa-file-pdf"></i>
                                            </span>
                                        </div>
                                        @elseif($dokumen->tipe_file == 'video')
                                        <div class="py-3 position-relative" style="height: 100px;">
                                            <div class="h-100 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-file-video fa-3x text-warning"></i>
                                            </div>
                                            <span class="badge bg-warning position-absolute top-0 end-0 m-1">
                                                <i class="fas fa-video"></i>
                                            </span>
                                        </div>
                                        @else
                                        <div class="py-3 position-relative" style="height: 100px;">
                                            <div class="h-100 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-file fa-3x text-secondary"></i>
                                            </div>
                                            <span class="badge bg-secondary position-absolute top-0 end-0 m-1">
                                                <i class="fas fa-file"></i>
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <!-- File Info -->
                                    <div class="text-center">
                                        <p class="file-name small fw-semibold mb-1 text-truncate" 
                                           title="{{ $dokumen->nama_file }}">
                                            {{ Str::limit($dokumen->nama_file, 25) }}
                                        </p>
                                        
                                        @if($dokumen->ukuran_file)
                                        <p class="file-meta small text-muted mb-2">
                                            <i class="fas fa-weight-hanging me-1"></i>
                                            {{ $dokumen->ukuran_file }}
                                        </p>
                                        @endif
                                        
                                        <p class="file-meta small text-muted mb-3">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $dokumen->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="btn-group-action mt-2">
                                        <!-- Preview Button -->
                                        @if(in_array($dokumen->tipe_file, ['image', 'document', 'video']))
                                        <button type="button" 
                                                class="btn-action btn btn-info" 
                                                title="Preview"
                                                onclick="previewFile('{{ $dokumen->id }}', '{{ $dokumen->tipe_file }}', '{{ $dokumen->nama_file }}')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @endif
                                        
                                        <!-- Download Button -->
                                        <a href="{{ route('admin.lembaga.dokumen.download', ['lembaga' => $lembaga->id, 'id' => $dokumen->id]) }}" 
                                           class="btn-action btn btn-success" 
                                           title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        
                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.lembaga.dokumen.hapus', ['lembaga' => $lembaga->id, 'id' => $dokumen->id]) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn-action btn btn-danger" 
                                                    title="Hapus"
                                                    onclick="return confirm('Hapus dokumen {{ $dokumen->nama_file }}?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-folder-open fa-4x text-muted opacity-50"></i>
                        </div>
                        <h5 class="text-gray-800 mb-3">Belum Ada Dokumen</h5>
                        <p class="text-muted mb-4">Tambahkan dokumen untuk lembaga ini</p>
                        <a href="{{ route('admin.lembaga.edit', $lembaga->id) }}#dokumen" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Dokumen
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Members Card -->
            <div class="card dashboard-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-users me-2"></i>Daftar Anggota
                        <span class="badge bg-light text-dark ms-2">{{ $lembaga->anggotas->count() }}</span>
                    </h6>
                    <a href="{{ route('admin.lembaga.anggota.index', $lembaga->id) }}" class="btn btn-sm btn-light">
                        <i class="fas fa-plus me-1"></i>Tambah Anggota
                    </a>
                </div>
                <div class="card-body">
                    @if($lembaga->anggotas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th class="fw-semibold text-gray-700">Nama Anggota</th>
                                    <th class="fw-semibold text-gray-700">Jabatan</th>
                                    <th class="fw-semibold text-gray-700">Level</th>
                                    <th class="fw-semibold text-gray-700">Periode</th>
                                    <th class="fw-semibold text-gray-700 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lembaga->anggotas as $anggota)
                                <tr>
                                    <td>
                                        <div>
                                            <strong class="text-gray-800">{{ $anggota->warga->nama }}</strong>
                                            @if($anggota->warga->nik)
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fas fa-id-card me-1"></i>
                                                    {{ $anggota->warga->nik }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-gray-800 fw-medium">{{ $anggota->jabatan->nama_jabatan }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $levelClass = 'bg-info';
                                            $levelText = $anggota->jabatan->level;
                                            
                                            if($levelText == 'Ketua') {
                                                $levelClass = 'bg-primary';
                                            } elseif($levelText == 'Sekretaris') {
                                                $levelClass = 'bg-info';
                                            } elseif($levelText == 'Bendahara') {
                                                $levelClass = 'bg-warning';
                                            } elseif($levelText == 'Anggota') {
                                                $levelClass = 'bg-secondary';
                                            }
                                        @endphp
                                        <span class="badge {{ $levelClass }} badge-level">
                                            {{ $levelText }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="small">
                                            <div class="text-gray-800">
                                                <i class="fas fa-calendar-start me-1"></i>
                                                {{ $anggota->tgl_mulai->format('d/m/Y') }}
                                            </div>
                                            @if($anggota->tgl_selesai)
                                                <div class="text-muted">
                                                    <i class="fas fa-calendar-end me-1"></i>
                                                    {{ $anggota->tgl_selesai->format('d/m/Y') }}
                                                </div>
                                            @else
                                                <div class="text-success">
                                                    <i class="fas fa-infinity me-1"></i>
                                                    Sekarang
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($anggota->tgl_selesai && $anggota->tgl_selesai < now())
                                            <span class="member-status inactive">
                                                <i class="fas fa-times-circle me-1"></i>Tidak Aktif
                                            </span>
                                        @elseif($anggota->tgl_selesai && $anggota->tgl_selesai > now())
                                            <span class="member-status ending">
                                                <i class="fas fa-clock me-1"></i>Akan Berakhir
                                            </span>
                                        @else
                                            <span class="member-status active">
                                                <i class="fas fa-check-circle me-1"></i>Aktif
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-users fa-4x text-muted opacity-50"></i>
                        </div>
                        <h5 class="text-gray-800 mb-3">Belum Ada Anggota</h5>
                        <p class="text-muted mb-4">Tambahkan anggota untuk lembaga ini</p>
                        <a href="{{ route('admin.lembaga.anggota.index', $lembaga->id) }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Anggota
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Stats & Actions -->
        <div class="col-lg-4">
            <!-- Statistics Card -->
            <div class="card dashboard-card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-chart-pie me-2"></i>Statistik Lembaga
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="stats-card border-left-primary p-4 rounded">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                            <i class="fas fa-tag fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-4">
                                        <div class="h2 mb-1 fw-bold">{{ $lembaga->jabatans_count }}</div>
                                        <div class="text-muted">Total Jabatan</div>
                                        <a href="{{ route('admin.lembaga.jabatan.index', $lembaga->id) }}" 
                                           class="small text-primary text-decoration-none">
                                            Lihat semua <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="stats-card border-left-success p-4 rounded">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                            <i class="fas fa-users fa-2x text-success"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-4">
                                        <div class="h2 mb-1 fw-bold">{{ $lembaga->anggotas_count }}</div>
                                        <div class="text-muted">Total Anggota</div>
                                        <a href="{{ route('admin.lembaga.anggota.index', $lembaga->id) }}" 
                                           class="small text-success text-decoration-none">
                                            Lihat semua <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="stats-card border-left-warning p-4 rounded">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                            <i class="fas fa-paperclip fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-4">
                                        <div class="h2 mb-1 fw-bold">{{ $lembaga->dokumens->count() }}</div>
                                        <div class="text-muted">Total Dokumen</div>
                                        <a href="#dokumen" class="small text-warning text-decoration-none">
                                            Lihat semua <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card dashboard-card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="card-body quick-actions">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.lembaga.jabatan.index', $lembaga->id) }}" 
                           class="btn btn-info">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-tags fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">Kelola Jabatan</div>
                                    <small class="text-white text-opacity-75">Atur struktur jabatan</small>
                                </div>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                        
                        <a href="{{ route('admin.lembaga.anggota.index', $lembaga->id) }}" 
                           class="btn btn-success">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-users fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">Kelola Anggota</div>
                                    <small class="text-white text-opacity-75">Tambah & atur anggota</small>
                                </div>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                        
                        <a href="{{ route('admin.lembaga.edit', $lembaga->id) }}" 
                           class="btn btn-warning">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-edit fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">Edit Lembaga</div>
                                    <small class="text-white text-opacity-75">Ubah data lembaga</small>
                                </div>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                        
                        <button type="button" 
                                class="btn btn-danger" 
                                onclick="confirmDelete()">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-trash fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">Hapus Lembaga</div>
                                    <small class="text-white text-opacity-75">Hapus permanen</small>
                                </div>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- System Info Card -->
            <div class="card dashboard-card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle me-2"></i>Informasi Sistem
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                            <div>
                                <i class="fas fa-fingerprint text-primary me-3"></i>
                                <span class="text-muted">ID Lembaga</span>
                            </div>
                            <span class="fw-semibold">{{ $lembaga->id }}</span>
                        </div>
                        
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                            <div>
                                <i class="fas fa-calendar-plus text-success me-3"></i>
                                <span class="text-muted">Dibuat</span>
                            </div>
                            <span class="fw-semibold">{{ $lembaga->created_at->format('d/m/Y') }}</span>
                        </div>
                        
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                            <div>
                                <i class="fas fa-calendar-check text-info me-3"></i>
                                <span class="text-muted">Diupdate</span>
                            </div>
                            <span class="fw-semibold">{{ $lembaga->updated_at->format('d/m/Y') }}</span>
                        </div>
                        
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                            <div>
                                <i class="fas fa-database text-warning me-3"></i>
                                <span class="text-muted">Status</span>
                            </div>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- File Preview Modal -->
<div class="modal fade file-preview-modal" id="filePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewTitle">Preview File</h5>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-light" id="downloadBtn" style="display: none;">
                        <i class="fas fa-download me-1"></i>Download
                    </button>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="preview-container" id="previewContent">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-4">
                    <i class="fas fa-trash fa-4x text-danger"></i>
                </div>
                <h5 class="mb-3">Hapus Lembaga "{{ $lembaga->nama_lembaga }}"?</h5>
                <p class="text-muted">
                    Aksi ini akan menghapus semua data lembaga termasuk anggota, jabatan, dan dokumen. 
                    Data tidak dapat dikembalikan.
                </p>
                <div class="alert alert-warning mt-3">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Pastikan tidak ada transaksi atau data penting yang terhubung dengan lembaga ini.
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.lembaga.destroy', $lembaga->id) }}" method="POST" class="w-100">
                    @csrf
                    @method('DELETE')
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Ya, Hapus Lembaga
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Image fallback
    document.querySelectorAll('img').forEach(img => {
        img.onerror = function() {
            if (!this.classList.contains('img-error')) {
                this.src = '{{ asset("assets/img/default-image.jpg") }}';
                this.classList.add('img-error');
            }
        };
    });
    
    // File preview modal
    const filePreviewModal = new bootstrap.Modal(document.getElementById('filePreviewModal'));
    const previewContent = document.getElementById('previewContent');
    const previewTitle = document.getElementById('previewTitle');
    const downloadBtn = document.getElementById('downloadBtn');
    
    // Preview functions
    window.previewFile = function(dokumenId, fileType, fileName) {
        // Reset modal content
        previewContent.innerHTML = '';
        previewTitle.textContent = 'Memuat...';
        downloadBtn.style.display = 'none';
        
        // Get file details - FIX URL
        fetch(`/lembaga/api/dokumen/${dokumenId}/details`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    previewTitle.textContent = fileName;
                    downloadBtn.style.display = 'block';
                    downloadBtn.onclick = function() {
                        window.location.href = data.data.url_download;
                    };
                    
                    // Render based on file type
                    switch(fileType) {
                        case 'image':
                            previewImage(data.data.url_view);
                            break;
                        case 'document':
                            if (fileName.toLowerCase().endsWith('.pdf')) {
                                previewDocument(data.data.url_view);
                            } else {
                                showNoPreview(data.data.url_download);
                            }
                            break;
                        case 'video':
                            previewVideo(data.data.url_view);
                            break;
                        default:
                            showNoPreview(data.data.url_download);
                            break;
                    }
                } else {
                    showNoPreview();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNoPreview();
            });
        
        // Show modal
        filePreviewModal.show();
    };
    
    function previewImage(url) {
        previewContent.innerHTML = `
            <div class="d-flex justify-content-center align-items-center h-100">
                <img src="${url}" class="preview-image" alt="Preview Image" 
                     style="max-width: 100%; max-height: 100%; object-fit: contain;">
            </div>
        `;
    }
    
    function previewDocument(url) {
        previewContent.innerHTML = `
            <div class="h-100">
                <iframe src="${url}" class="preview-document h-100 w-100" 
                        frameborder="0" title="Document Preview"></iframe>
            </div>
        `;
    }
    
    function previewVideo(url) {
        previewContent.innerHTML = `
            <div class="d-flex justify-content-center align-items-center h-100">
                <video controls class="preview-video" style="max-width: 100%; max-height: 100%;">
                    <source src="${url}" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>
        `;
    }
    
    function showNoPreview(downloadUrl = '') {
        previewContent.innerHTML = `
            <div class="no-preview">
                <i class="fas fa-eye-slash fa-4x mb-4 text-muted"></i>
                <h5 class="mb-3">Preview Tidak Tersedia</h5>
                <p class="text-muted mb-4">File ini tidak dapat ditampilkan di browser</p>
                ${downloadUrl ? `
                    <a href="${downloadUrl}" class="btn btn-primary mt-3">
                        <i class="fas fa-download me-2"></i>Download File
                    </a>
                ` : ''}
            </div>
        `;
    }
    
    // Image modal
    window.openImageModal = function(src, title) {
        previewContent.innerHTML = `
            <div class="d-flex justify-content-center align-items-center h-100">
                <img src="${src}" class="preview-image" alt="${title}"
                     style="max-width: 100%; max-height: 100%; object-fit: contain;">
            </div>
        `;
        previewTitle.textContent = title;
        downloadBtn.style.display = 'none';
        filePreviewModal.show();
    };
    
    // Delete confirmation for lembaga
    window.confirmDelete = function() {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        deleteModal.show();
    };
    
    // Delete confirmation for dokumen
    document.querySelectorAll('form.dokumen-delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) {
                e.preventDefault();
            }
        });
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Escape to close modal
        if (e.key === 'Escape' && document.querySelector('.modal.show')) {
            const modal = bootstrap.Modal.getInstance(document.querySelector('.modal.show'));
            if (modal) {
                modal.hide();
            }
        }
        
        // Ctrl+P to print
        if (e.ctrlKey && e.key === 'p') {
            e.preventDefault();
            window.print();
        }
    });
    
    // Smooth scroll to sections
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId !== '#') {
                e.preventDefault();
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
});
</script>
@endsection