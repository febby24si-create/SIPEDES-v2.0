@extends('layouts.admin.app')

@section('title', 'Edit Lembaga Desa')

@section('content')
<div class="container-fluid py-4">
    
    <div class="row mb-4 px-2">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold text-dark mb-1">
                    <i class="fas fa-edit text-primary me-2"></i>Edit Lembaga
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.lembaga.index') }}">Lembaga</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.lembaga.index') }}" class="btn btn-secondary btn-lg">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <form action="{{ route('admin.lembaga.update', $lembaga->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 fw-bold text-dark"><i class="fas fa-info-circle me-2 text-primary"></i>Informasi Dasar</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Nama Lembaga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white border-0"><i class="fas fa-building"></i></span>
                                <input type="text" class="form-control @error('nama_lembaga') is-invalid @enderror" 
                                       name="nama_lembaga" value="{{ old('nama_lembaga', $lembaga->nama_lembaga) }}" required>
                            </div>
                            @error('nama_lembaga') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Kontak</label>
                            <div class="input-group">
                                <span class="input-group-text bg-info text-white border-0"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control @error('kontak') is-invalid @enderror" 
                                       name="kontak" value="{{ old('kontak', $lembaga->kontak) }}">
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold text-dark">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="8" required>{{ old('deskripsi', $lembaga->deskripsi) }}</textarea>
                            <div class="d-flex justify-content-between mt-2">
                                <small class="text-muted">Minimal 50 karakter</small>
                                <small id="deskripsi-counter" class="fw-bold text-muted">0 karakter</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 fw-bold text-dark"><i class="fas fa-file-alt me-2 text-primary"></i>Berkas & Dokumen</h6>
                    </div>
                    <div class="card-body p-4">
                        @if($lembaga->dokumens->count() > 0)
                        <div class="row row-cols-2 row-cols-md-4 g-3 mb-4">
                            @foreach($lembaga->dokumens as $dokumen)
                            <div class="col">
                                <div class="card h-100 border text-center p-2">
                                    <div class="mb-2">
                                        @if($dokumen->tipe_file == 'image')
                                            <img src="{{ asset('storage/' . $dokumen->path_file) }}" class="rounded img-fluid" style="height: 60px; object-fit: cover;">
                                        @else
                                            <i class="fas {{ $dokumen->tipe_file == 'video' ? 'fa-file-video text-warning' : 'fa-file-pdf text-danger' }} fa-3x"></i>
                                        @endif
                                    </div>
                                    <p class="small text-truncate mb-2">{{ $dokumen->nama_file }}</p>
                                    <div class="btn-group w-100">
                                        <a href="{{ route('admin.lembaga.dokumen.download', [$lembaga->id, $dokumen->id]) }}" class="btn btn-sm btn-outline-success p-1"><i class="fas fa-download"></i></a>
                                        <button type="button" class="btn btn-sm btn-outline-danger p-1" onclick="deleteDocument('{{ route('admin.lembaga.dokumen.hapus', [$lembaga->id, $dokumen->id]) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <label class="form-label fw-bold text-dark">Tambah Dokumen Baru</label>
                        <input type="file" name="dokumen[]" class="form-control" multiple>
                        <small class="text-muted mt-2 d-block">Maksimal 10MB per file.</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 fw-bold text-dark"><i class="fas fa-image me-2 text-primary"></i>Logo Lembaga</h6>
                    </div>
                    <div class="card-body text-center p-4">
                        <div id="logo-preview-box" class="bg-light rounded p-3 mb-3 border border-2 border-dashed d-flex align-items-center justify-content-center" style="height: 200px;">
                            @if($lembaga->logo)
                                <img src="{{ asset('storage/' . $lembaga->logo) }}" id="logo-img" class="img-fluid rounded shadow-sm" style="max-height: 170px;">
                            @else
                                <div id="logo-placeholder">
                                    <i class="fas fa-image fa-4x text-muted"></i>
                                    <p class="small text-muted mt-2">Belum ada logo</p>
                                </div>
                            @endif
                        </div>
                        <input type="file" name="logo" class="form-control form-control-sm mb-3" onchange="previewLogo(this)">
                        
                        @if($lembaga->logo)
                        <div class="form-check text-start">
                            <input class="form-check-input" type="checkbox" name="remove_logo" id="remove_logo">
                            <label class="form-check-label text-danger small fw-bold" for="remove_logo">Hapus logo saat ini</label>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-users fa-2x text-primary me-3"></i>
                            <div>
                                <small class="text-muted d-block">Total Anggota</small>
                                <span class="h5 fw-bold">{{ $lembaga->anggotas_count }} Orang</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-sitemap fa-2x text-info me-3"></i>
                            <div>
                                <small class="text-muted d-block">Jumlah Jabatan</small>
                                <span class="h5 fw-bold">{{ $lembaga->jabatans_count }} Jabatan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body d-grid gap-2">
                        <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.lembaga.show', $lembaga->id) }}" class="btn btn-outline-info py-2">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
                    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-grid gap-2 d-md-flex">
                <a href="{{ route('admin.lembaga.show', $lembaga->id) }}" class="btn btn-info">
                    <i class="fas fa-eye me-2"></i>Lihat Detail
                </a>
                <a href="{{ route('admin.lembaga.anggota.index', $lembaga->id) }}" class="btn btn-success">
                    <i class="fas fa-users me-2"></i>Kelola Anggota
                </a>
                <a href="{{ route('admin.lembaga.jabatan.index', $lembaga->id) }}" class="btn btn-warning">
                    <i class="fas fa-tags me-2"></i>Kelola Jabatan
                </a>
            </div>
        </div>
    </div>
            </div>
        </div>
    </form>
</div>

<form id="delete-doc-form" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script>
    // Preview Logo Baru
    function previewLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const box = document.getElementById('logo-preview-box');
                box.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded shadow-sm" style="max-height: 170px;">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Counter Deskripsi
    const desc = document.getElementById('deskripsi');
    const counter = document.getElementById('deskripsi-counter');
    
    function updateCounter() {
        const len = desc.value.length;
        counter.innerText = len + ' karakter';
        counter.className = len < 50 ? 'fw-bold text-danger' : 'fw-bold text-success';
    }
    desc.addEventListener('input', updateCounter);
    updateCounter();

    // Hapus Dokumen
    function deleteDocument(url) {
        if (confirm('Yakin ingin menghapus dokumen ini?')) {
            const form = document.getElementById('delete-doc-form');
            form.action = url;
            form.submit();
        }
    }
</script>
@endpush

<style>
    .input-group-text { width: 45px; justify-content: center; }
    .border-dashed { border-style: dashed !important; }
    .card { border-radius: 10px; }
</style>