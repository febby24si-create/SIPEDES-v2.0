<!-- resources/views/pages/lembaga/edit.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Edit Lembaga Desa')
@section('page_title', 'Edit Lembaga')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5">
        <div class="mb-3 mb-md-0">
            <h1 class="dashboard-page-title mb-2">
                <i class="fas fa-edit me-3"></i>Edit Lembaga Desa
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.lembaga.index') }}" class="text-decoration-none text-muted">Lembaga Desa</a>
                    </li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.lembaga.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <!-- Card Form -->
    <div class="card dashboard-card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-edit me-2"></i>Form Edit Lembaga Desa
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.lembaga.update', $lembaga->id) }}" method="POST" id="formEditLembaga" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Nama Lembaga -->
                    <div class="col-md-6 mb-3">
                        <label for="nama_lembaga" class="form-label fw-bold">
                            Nama Lembaga <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-building"></i>
                            </span>
                            <input type="text" class="form-control @error('nama_lembaga') is-invalid @enderror" 
                                   id="nama_lembaga" name="nama_lembaga" value="{{ old('nama_lembaga', $lembaga->nama_lembaga) }}" 
                                   placeholder="Masukkan nama lembaga desa" required>
                            @error('nama_lembaga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Kontak -->
                    <div class="col-md-6 mb-3">
                        <label for="kontak" class="form-label fw-bold">
                            Kontak
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white">
                                <i class="fas fa-phone"></i>
                            </span>
                            <input type="text" class="form-control @error('kontak') is-invalid @enderror" 
                                   id="kontak" name="kontak" value="{{ old('kontak', $lembaga->kontak) }}" 
                                   placeholder="Nomor telepon atau email">
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Logo Lembaga -->
                <div class="mb-3">
                    <label for="logo" class="form-label fw-bold">
                        Logo Lembaga
                    </label>
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Current Logo -->
                            <div class="card">
                                <div class="card-body text-center">
                                    @if($lembaga->logo)
                                        <img src="{{ asset('storage/' . $lembaga->logo) }}" 
                                             id="current-logo" 
                                             class="img-fluid rounded" 
                                             alt="Current Logo" 
                                             style="max-height: 150px;">
                                        <div class="mt-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remove_logo" id="remove_logo">
                                                <label class="form-check-label text-danger" for="remove_logo">
                                                    Hapus logo
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="py-4">
                                            <i class="fas fa-building fa-4x text-muted"></i>
                                            <p class="text-muted mt-2">Belum ada logo</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <!-- New Logo Upload & Preview -->
                            <div class="input-group mb-3">
                                <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                       id="logo" name="logo" accept="image/*">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text text-muted">
                                Format: JPG, PNG, JPEG. Maksimal 2MB. Ukuran disarankan 300x300px.
                            </div>
                            
                            <!-- Preview New Logo -->
                            <div id="new-logo-preview" class="mt-3 text-center" style="display: none;">
                                <p class="text-muted">Preview Logo Baru:</p>
                                <img id="preview-new-logo" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                <div class="mt-2">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeNewLogoPreview()">
                                        <i class="fas fa-times me-1"></i> Hapus Preview
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- Dokumen Lembaga -->
<div class="mb-3">
    <label class="form-label fw-bold">
        Dokumen & Media Lembaga
    </label>
    
    <!-- Dokumen Saat Ini -->
    @if($lembaga->dokumens->count() > 0)
    <div class="mb-3">
        <p class="fw-semibold text-muted mb-2">Dokumen Saat Ini:</p>
        <div class="row g-2">
            @foreach($lembaga->dokumens as $dokumen)
            <div class="col-md-3 mb-2">
                <div class="card border dokumen-item">
                    <div class="card-body p-2 text-center">
                        @if($dokumen->tipe_file == 'image')
                        <img src="{{ asset('storage/' . $dokumen->path_file) }}" 
                             class="img-fluid rounded mb-2" 
                             style="height: 80px; object-fit: cover;">
                        @elseif($dokumen->tipe_file == 'document')
                        <i class="fas fa-file-pdf fa-3x text-danger mb-2"></i>
                        @elseif($dokumen->tipe_file == 'video')
                        <i class="fas fa-file-video fa-3x text-warning mb-2"></i>
                        @else
                        <i class="fas fa-file fa-3x text-secondary mb-2"></i>
                        @endif
                        <p class="small text-truncate mb-1" title="{{ $dokumen->nama_file }}">
                            {{ $dokumen->nama_file }}
                        </p>
                        @if($dokumen->ukuran_file)
                        <p class="small text-muted">{{ $dokumen->ukuran_file }}</p>
                        @endif
                    </div>
<div class="card-footer p-1 bg-transparent border-top-0">
    <div class="d-flex justify-content-center gap-1">

        <!-- Tombol Download -->
        <a href="{{ route('admin.lembaga.dokumen.download', ['lembaga' => $lembaga->id, 'id' => $dokumen->id]) }}" 
           class="btn btn-sm btn-success" title="Download">
            <i class="fas fa-download"></i>
        </a>

        <!-- Tombol Hapus -->
        {{-- <form action="{{ route('admin.lembaga.dokumen.hapus', ['lembaga' => $lembaga->id, 'id' => $dokumen->id]) }}" 
              method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" 
                    onclick="return confirm('Hapus dokumen ini?')"
                    title="Hapus">
                <i class="fas fa-trash"></i>
            </button>
        </form> --}}
<!-- Tombol Hapus -->
<form action="{{ route('admin.lembaga.dokumen.hapus', ['lembaga' => $lembaga->id, 'id' => $dokumen->id]) }}" 
      method="POST" class="d-inline dokumen-delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" 
            onclick="return confirm('Hapus dokumen ini?')"
            title="Hapus">
        <i class="fas fa-trash"></i>
    </button>
</form>
    </div>
</div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <!-- Tambah Dokumen Baru -->
    <div class="input-group mb-3">
        <input type="file" class="form-control @error('dokumen') is-invalid @enderror" 
               id="dokumen" name="dokumen[]" multiple 
               accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.mp4,.avi,.mov">
        @error('dokumen')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-text text-muted">
        Tambah file baru: gambar, dokumen, atau video. Maksimal 10MB per file.
    </div>
</div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">
                        Deskripsi <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="6" 
                              placeholder="Jelaskan tentang lembaga desa, tugas, dan fungsinya" required>{{ old('deskripsi', $lembaga->deskripsi) }}</textarea>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-text text-muted">Minimal 50 karakter</div>
                        <div id="deskripsi-counter" class="form-text text-muted">0 karakter</div>
                    </div>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Stats Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border-left-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-users fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted">Jumlah Anggota</div>
                                        <div class="h5 mb-0">{{ $lembaga->anggotas_count }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-left-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-tag fa-2x text-info"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted">Jumlah Jabatan</div>
                                        <div class="h5 mb-0">{{ $lembaga->jabatans_count }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('admin.lembaga.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
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


@endsection

