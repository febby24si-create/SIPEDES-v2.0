<!-- resources/views/lembaga/anggota_index.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Anggota Lembaga')
@section('page_title', 'LEMBAGA SIPEDES')

@section('content')
<div class="container-fluid">

    <!-- Header Section -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div class="mr-3">
                    <div class="bg-primary rounded-circle p-3 text-white shadow">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
                <div>
                    <h1 class="h3 mb-1 text-gray-800 font-weight-bold">Anggota Lembaga</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-gray-600">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.lembaga.index') }}" class="text-decoration-none text-gray-600">Lembaga Desa</a></li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">{{ $lembaga->nama_lembaga }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-md-right">
            <div class="btn-group" role="group">
                <a href="{{ route('admin.lembaga.anggota.create', $lembaga->id) }}"
                    class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Anggota
                </a>
                <a href="{{ route('admin.lembaga.index') }}" class="btn btn-outline-secondary shadow-sm ml-2">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Informasi Lembaga -->
    <div class="card border-left-primary shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="card-title font-weight-bold text-primary mb-1">{{ $lembaga->nama_lembaga }}</h4>
                    <p class="card-text text-muted mb-0">{{ Str::limit($lembaga->deskripsi, 150) }}</p>
                    @if($lembaga->kontak)
                        <div class="mt-2">
                            <small class="text-muted"><i class="fas fa-phone mr-1"></i> {{ $lembaga->kontak }}</small>
                        </div>
                    @endif
                </div>
                <div class="col-md-4 text-md-right">
                    <div class="text-md-right">
                        <span class="badge badge-primary badge-lg p-2">Total: {{ $anggotas->count() }} Anggota</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Anggota
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anggotas->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ketua & Wakil
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $anggotas->whereIn('jabatan.level', ['Ketua', 'Wakil Ketua'])->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-crown fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Anggota Aktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $anggotas->where('tgl_selesai', null)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Masa Tenggang
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $anggotas->where('tgl_selesai', '<=', now()->addDays(30))->where('tgl_selesai', '>', now())->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Anggota -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-column flex-md-row justify-content-between align-items-center bg-white">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list mr-2"></i>Daftar Anggota
            </h6>
            <div class="mt-2 mt-md-0">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control border-primary" placeholder="Cari anggota..." id="searchInput">
                    <div class="input-group-append">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if($anggotas->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-users fa-4x text-muted opacity-25"></i>
                    </div>
                    <h5 class="text-muted font-weight-normal">Belum ada anggota untuk lembaga ini</h5>
                    <p class="text-muted mb-4">Mulai dengan menambahkan anggota pertama untuk lembaga {{ $lembaga->nama_lembaga }}</p>
                    <a href="{{ route('admin.lembaga.anggota.create', $lembaga->id) }}"
                        class="btn btn-primary btn-lg shadow-sm px-4">
                        <i class="fas fa-plus-circle mr-2"></i>Tambah Anggota Pertama
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="anggotaTable" width="100%" cellspacing="0">
                        <thead class="bg-gradient-primary text-white">
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%">Nama Anggota</th>
                                <th width="20%">Jabatan</th>
                                <th width="15%">Level</th>
                                <th width="20%">Periode</th>
                                <th width="10%">Status</th>
                                <th width="5%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggotas as $index => $anggota)
                            <tr class="align-middle">
                                <td class="text-center">
                                    <span class="text-muted font-weight-bold">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <span class="text-white font-weight-bold">{{ substr($anggota->warga->nama, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold text-dark">{{ $anggota->warga->nama }}</h6>
                                            <small class="text-muted">NIK: {{ $anggota->warga->nik }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="font-weight-bold text-primary">{{ $anggota->jabatan->nama_jabatan }}</span>
                                </td>
                                <td>
                                    @php
                                        $levelClass = [
                                            'Ketua' => 'success',
                                            'Wakil Ketua' => 'success',
                                            'Sekretaris' => 'info',
                                            'Bendahara' => 'warning',
                                            'Anggota' => 'secondary'
                                        ][$anggota->jabatan->level] ?? 'dark';
                                        
                                        $levelIcon = [
                                            'Ketua' => 'crown',
                                            'Wakil Ketua' => 'user-tie',
                                            'Sekretaris' => 'pen',
                                            'Bendahara' => 'money-bill',
                                            'Anggota' => 'user'
                                        ][$anggota->jabatan->level] ?? 'star';
                                    @endphp
                                    <span class="badge badge-{{ $levelClass }} badge-pill py-2 px-3 shadow-sm">
                                        <i class="fas fa-{{ $levelIcon }} mr-1"></i> {{ $anggota->jabatan->level }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted">Mulai:</small>
                                        <span class="font-weight-bold text-dark">{{ $anggota->tgl_mulai->format('d M Y') }}</span>
                                        @if($anggota->tgl_selesai)
                                            <small class="text-muted mt-1">Selesai:</small>
                                            <span class="font-weight-bold text-dark">{{ $anggota->tgl_selesai->format('d M Y') }}</span>
                                        @else
                                            <span class="badge badge-light border mt-1">Masih Menjabat</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($anggota->tgl_selesai && $anggota->tgl_selesai < now())
                                        <span class="badge badge-danger badge-pill py-2 px-3 shadow-sm">
                                            <i class="fas fa-times-circle mr-1"></i> Tidak Aktif
                                        </span>
                                    @elseif($anggota->tgl_selesai && $anggota->tgl_selesai->diffInDays(now()) <= 30)
                                        <span class="badge badge-warning badge-pill py-2 px-3 shadow-sm text-white">
                                            <i class="fas fa-clock mr-1"></i> Akan Berakhir
                                        </span>
                                    @else
                                        <span class="badge badge-success badge-pill py-2 px-3 shadow-sm">
                                            <i class="fas fa-check-circle mr-1"></i> Aktif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.lembaga.anggota.edit', [$lembaga->id, $anggota->id]) }}"
                                                class="btn btn-outline-warning shadow-sm" 
                                                title="Edit Anggota"
                                                data-toggle="tooltip">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-outline-danger shadow-sm"
                                                    title="Hapus Anggota"
                                                    data-toggle="modal" 
                                                    data-target="#deleteModal{{ $anggota->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $anggota->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $anggota->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $anggota->id }}">
                                                        <i class="fas fa-exclamation-triangle mr-2"></i>Konfirmasi Hapus
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus anggota <strong>{{ $anggota->warga->nama }}</strong> dari lembaga <strong>{{ $lembaga->nama_lembaga }}</strong>?</p>
                                                    <p class="text-muted">Data yang dihapus tidak dapat dikembalikan.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('admin.lembaga.anggota.destroy', [$lembaga->id, $anggota->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('anggotaTable');
        
        if (searchInput && table) {
            searchInput.addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                
                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    let found = false;
                    
                    for (let j = 0; j < cells.length; j++) {
                        const cellText = cells[j].textContent || cells[j].innerText;
                        if (cellText.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                    
                    rows[i].style.display = found ? '' : 'none';
                }
            });
        }
        
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush

@push('styles')
<style>
    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 0;
    }
    
    .breadcrumb-item a {
        color: #6e707e;
        transition: color 0.3s;
    }
    
    .breadcrumb-item a:hover {
        color: #4e73df;
        text-decoration: none;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4e73df, #224abe) !important;
    }
    
    .badge-lg {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }
    
    .card-header {
        border-bottom: 1px solid #e3e6f0;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .btn-group-sm > .btn {
        border-radius: 0.35rem;
    }
    
    /* Avatar circle */
    .bg-primary.rounded-circle {
        background-color: #4e73df !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    
    /* Hover effects */
    .table-hover tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
        transform: translateY(-1px);
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .btn-group {
            flex-direction: column;
            width: 100%;
        }
        
        .btn-group .btn {
            margin-bottom: 0.5rem;
            width: 100%;
        }
        
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .badge {
            font-size: 0.75rem;
        }
    }
</style>
@endpush