@extends('layouts.admin.app')

@section('title', 'Perangkat Desa')

@section('content')
<style>
/* === CONSISTENT GLASSMORPHISM STYLE === */
.glass-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 18px;
    border: 1px solid #cbd5e1;
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.glass-header {
    background: linear-gradient(135deg, #1e40af, #3b82f6) !important;
    color: #ffffff !important;
    backdrop-filter: blur(12px);
    border-bottom: none;
    border-radius: 18px 18px 0 0 !important;
    padding: 1rem 1.25rem !important;
}

.glass-header h6 {
    color: #ffffff !important;
    margin: 0 !important;
    font-weight: 600 !important;
}

.glass-table {
    margin-bottom: 0;
}

.glass-table thead {
    background: rgba(59, 130, 246, 0.1);
    color: #1e293b;
    backdrop-filter: blur(8px);
}

.glass-table thead th {
    color: #1e293b !important;
    font-weight: 600;
    border-bottom: 2px solid #cbd5e1;
    padding: 0.875rem;
}

.glass-table tbody tr {
    color: #1e293b !important;
    transition: all 0.3s ease;
}

.glass-table tbody td {
    color: #1e293b !important;
    padding: 0.875rem;
    vertical-align: middle;
    border-bottom: 1px solid #e2e8f0;
}

.glass-table tbody tr:hover {
    background: rgba(59, 130, 246, 0.08);
    transform: translateX(2px);
}

.btn-glass {
    background: rgba(255, 255, 255, 0.9);
    color: #1e293b;
    backdrop-filter: blur(12px);
    border: 1px solid #cbd5e1;
    transition: all 0.2s ease;
    font-weight: 500;
}

.btn-glass:hover {
    background: rgba(59, 130, 246, 0.15);
    color: #1e293b;
    border-color: #3b82f6;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
}

.btn-primary.btn-glass {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    color: #ffffff;
    border: none;
}

.btn-primary.btn-glass:hover {
    background: linear-gradient(135deg, #2563eb, #1e3a8a);
    color: #ffffff;
}

.btn-secondary.btn-glass {
    background: rgba(148, 163, 184, 0.9);
    color: #ffffff;
}

.btn-secondary.btn-glass:hover {
    background: rgba(100, 116, 139, 1);
    color: #ffffff;
}

.btn-info.btn-glass {
    background: rgba(139, 92, 246, 0.9);
    color: #ffffff;
}

.btn-warning.btn-glass {
    background: rgba(245, 158, 11, 0.9);
    color: #ffffff;
}

.btn-danger.btn-glass {
    background: rgba(239, 68, 68, 0.9);
    color: #ffffff;
}

.badge-glass {
    background: rgba(59, 130, 246, 0.15);
    color: #1e293b;
    backdrop-filter: blur(6px);
    padding: 6px 14px;
    border-radius: 12px;
    font-weight: 500;
    border: 1px solid rgba(59, 130, 246, 0.2);
}

.badge-glass.bg-success {
    background: rgba(16, 185, 129, 0.9);
    color: #ffffff;
    border-color: rgba(16, 185, 129, 0.3);
}

.badge-glass.bg-danger {
    background: rgba(239, 68, 68, 0.9);
    color: #ffffff;
    border-color: rgba(239, 68, 68, 0.3);
}
c 
/* Form Control Glass */
.form-control-glass {
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    color: #1e293b;
    backdrop-filter: blur(8px);
    transition: all 0.3s ease;
}

.form-control-glass:focus {
    background: rgba(255, 255, 255, 1);
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    color: #1e293b;
}

.form-control-glass::placeholder {
    color: #94a3b8;
}

/* Filter Section */
.filter-section {
    background: rgba(248, 250, 252, 0.6);
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    border: 1px solid #e2e8f0;
}

/* Typography */
h1, h2, h3, h4, h5, h6 {
    color: #1e293b !important;
}

.h3 {
    color: #1e293b !important;
    font-weight: 700;
}

/* Text Colors */
.text-left strong {
    color: #1e293b !important;
}

.text-light {
    color: #64748b !important;
}

.text-success {
    color: #10b981 !important;
}

/* Image Styling */
.rounded-circle {
    border: 2px solid #cbd5e1 !important;
    transition: all 0.3s ease;
}

.rounded-circle:hover {
    transform: scale(1.1);
    border-color: #3b82f6 !important;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

/* Empty State */
.py-5 {
    color: #475569 !important;
}

.py-5 i {
    color: #94a3b8 !important;
}

.py-5 p {
    color: #64748b !important;
}

/* Pagination */
.pagination {
    margin: 0;
}

.pagination .page-link {
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid #cbd5e1;
    color: #1e293b;
    backdrop-filter: blur(8px);
    transition: all 0.2s ease;
}

.pagination .page-link:hover {
    background: rgba(59, 130, 246, 0.1);
    border-color: #3b82f6;
    color: #1e293b;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    border-color: #3b82f6;
    color: #ffffff;
}

/* Button Group */
.btn-group .btn {
    margin: 0 2px;
}

/* Responsive Gap Fix */
.d-flex.gap-2 {
    gap: 0.5rem !important;
}

@media (max-width: 768px) {
    .d-flex.gap-2 {
        flex-direction: column;
    }
    
    .d-flex.gap-2 .btn {
        width: 100%;
    }
}
</style>

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">
            <i class="fas fa-user-tie"></i> Perangkat Desa
        </h1>

        <a href="{{ route('admin.perangkat_desa.create') }}" class="btn btn-primary btn-glass shadow-sm">
            <i class="fas fa-plus"></i> Tambah Perangkat
        </a>
    </div>

    <!-- Glass Card -->
    <div class="card glass-card shadow-lg border-0">

        <div class="card-header glass-header">
            <h6 class="m-0 font-weight-bold">Daftar Perangkat Desa</h6>
        </div>

        <div class="card-body">
            <!-- Filter Section -->
            <div class="filter-section">
                <form action="{{ route('admin.perangkat_desa.index') }}" method="GET" class="mb-0">
                    <div class="row">
                        <!-- Search Input -->
                        <div class="col-md-4 mb-2">
                            <input type="text" class="form-control form-control-glass" 
                                   placeholder="Cari nama, NIK, jabatan, NIP, kontak..." 
                                   name="search" value="{{ request('search') }}">
                        </div>
                        
                        <!-- Jabatan Filter -->
                        <div class="col-md-3 mb-2">
                            <select name="jabatan_filter" class="form-control form-control-glass">
                                <option value="">Semua Jabatan</option>
                                @foreach($jabatan_list as $jabatan)
                                    <option value="{{ $jabatan }}" {{ request('jabatan_filter') == $jabatan ? 'selected' : '' }}>
                                        {{ $jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Status Filter -->
                        <div class="col-md-3 mb-2">
                            <select name="status_filter" class="form-control form-control-glass">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status_filter') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ request('status_filter') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-md-2 mb-2">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-glass flex-fill">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('admin.perangkat_desa.index') }}" class="btn btn-secondary btn-glass">
                                    <i class="fas fa-redo"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover glass-table align-middle">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>NIP</th>
                            <th>Kontak</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($perangkats as $perangkat)
                        <tr>
                            <td>
                                <img 
                                    src="{{ $perangkat->foto ? Storage::url($perangkat->foto) : asset('assets/img/default-user.png') }}" 
                                    width="55" 
                                    class="rounded-square shadow-sm"
                                >
                            </td>

                            <td class="text-left">
                                <strong>{{ $perangkat->warga->nama }}</strong><br>
                                <small class="text-light">NIK: {{ $perangkat->warga->nik }}</small>
                            </td>

                            <td>{{ $perangkat->jabatan }}</td>
                            <td>{{ $perangkat->nip ?? '-' }}</td>
                            <td>{{ $perangkat->kontak ?? '-' }}</td>

                            <td>
                                {{ $perangkat->periode_mulai->format('d/m/Y') }}
                                @if($perangkat->periode_selesai)
                                    - {{ $perangkat->periode_selesai->format('d/m/Y') }}
                                @else
                                    - <span class="text-success">Sekarang</span>
                                @endif
                            </td>

                            <td>
                                @if($perangkat->periode_selesai && $perangkat->periode_selesai < now())
                                    <span class="badge-glass bg-danger">Tidak Aktif</span>
                                @else
                                    <span class="badge-glass bg-success">Aktif</span>
                                @endif
                            </td>

                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.perangkat_desa.show', $perangkat->id) }}" 
                                       class="btn btn-info btn-sm btn-glass" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.perangkat_desa.edit', $perangkat->id) }}" 
                                       class="btn btn-warning btn-sm btn-glass" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.perangkat_desa.destroy', $perangkat->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Hapus perangkat desa ini?')"
                                                class="btn btn-danger btn-sm btn-glass" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="8" class="py-5">
                                <i class="fas fa-user-tie fa-3x mb-3"></i>
                                <p>Belum ada perangkat desa yang terdaftar.</p>
                                <a href="{{ route('admin.perangkat_desa.create') }}" class="btn btn-primary btn-lg btn-glass">
                                    <i class="fas fa-plus"></i> Tambah Perangkat Pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> {{-- table-responsive --}}

            {{-- pagination di luar table --}}
            @if($perangkats->hasPages())
            <div class="d-flex justify-content-end mt-3">
                {{ $perangkats->links('pagination::bootstrap-5') }}
            </div>
            @endif

        </div>
    </div>
</div>
@endsection