<!-- resources/views/lembaga/create.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Tambah Lembaga Desa')
@section('page_title', 'Tambah Lembaga')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div class="mb-3 mb-md-0">
            <h1 class="dashboard-page-title mb-2">
                <i class="fas fa-plus-circle text-primary me-3"></i>Tambah Lembaga Desa
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.lembaga.index') }}" class="text-decoration-none text-muted">Lembaga Desa</a>
                    </li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Tambah</li>
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
                <i class="fas fa-info-circle me-2"></i>Form Data Lembaga Desa
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.lembaga.store') }}" method="POST" id="formLembaga" enctype="multipart/form-data">
                @csrf
                
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
                                   id="nama_lembaga" name="nama_lembaga" value="{{ old('nama_lembaga') }}" 
                                   placeholder="Masukkan nama lembaga desa" required>
                            @error('nama_lembaga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text text-muted">
                            Contoh: Badan Permusyawaratan Desa, Lembaga Pemberdayaan Masyarakat, dll.
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
                                   id="kontak" name="kontak" value="{{ old('kontak') }}" 
                                   placeholder="Nomor telepon atau email">
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text text-muted">
                            Bisa berupa nomor telepon, email, atau media komunikasi lainnya.
                        </div>
                    </div>
                </div>

                <!-- Logo Lembaga -->
                <div class="mb-3">
                    <label for="logo" class="form-label fw-bold">
                        Logo Lembaga
                    </label>
                    <div class="input-group">
                        <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                               id="logo" name="logo" accept="image/*">
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text text-muted">
                        Format: JPG, PNG, JPEG. Maksimal 2MB. Ukuran disarankan 300x300px.
                    </div>
                    
                    <!-- Preview Logo -->
                    <div id="logo-preview" class="mt-3 text-center" style="display: none;">
                        <img id="preview-image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                        <div class="mt-2">
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeLogoPreview()">
                                <i class="fas fa-times me-1"></i> Hapus Preview
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">
                        Deskripsi <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="6" 
                              placeholder="Jelaskan tentang lembaga desa, tugas, dan fungsinya" required>{{ old('deskripsi') }}</textarea>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-text text-muted">Minimal 50 karakter</div>
                        <div id="deskripsi-counter" class="form-text text-muted">0 karakter</div>
                    </div>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('admin.lembaga.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                        <i class="fas fa-save me-2"></i>Simpan Lembaga
                    </button>
                </div>
            </form>
        </div>
    </div>
<!-- Dokumen Lembaga -->
<div class="mb-3">
    <label for="dokumen" class="form-label fw-bold">
        Dokumen & Media Lembaga
    </label>
    <div class="input-group">
        <input type="file" class="form-control @error('dokumen') is-invalid @enderror" 
               id="dokumen" name="dokumen[]" multiple 
               accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.mp4,.avi,.mov">
        @error('dokumen')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-text text-muted">
        Bisa upload gambar, dokumen (PDF, Word, Excel), dan video. Maksimal 10MB per file.
    </div>
</div>
    <!-- Informasi Tambahan -->
    <div class="card dashboard-card border-left-info mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-auto">
                    <i class="fas fa-info-circle fa-2x text-info"></i>
                </div>
                <div class="col">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tips</div>
                    <div class="text-gray-800 small">
                        Pastikan data yang dimasukkan sudah sesuai dan lengkap. Nama lembaga harus unik dan tidak boleh sama dengan lembaga yang sudah ada. 
                        Deskripsi harus jelas dan informatif untuk memahami tujuan dan fungsi lembaga.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<style>
.form-label {
    color: var(--text-primary) !important;
    margin-bottom: 0.5rem;
}

.form-control:focus {
    border-color: var(--primary) !important;
    box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25) !important;
}

.input-group-text {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
    border-color: var(--primary-dark) !important;
    color: #ffffff !important;
}

.input-group-text.bg-info {
    background: linear-gradient(135deg, var(--accent), #7c3aed) !important;
    border-color: #7c3aed !important;
}

.breadcrumb {
    background-color: transparent !important;
    padding: 0 !important;
    margin-bottom: 0 !important;
}

.breadcrumb-item a {
    color: var(--text-muted) !important;
    text-decoration: none !important;
    transition: color var(--transition-speed) ease !important;
}

.breadcrumb-item a:hover {
    color: var(--primary) !important;
}

.breadcrumb-item.active {
    color: var(--primary) !important;
}

.border-left-info {
    border-left: 4px solid var(--accent) !important;
}

.text-xs {
    font-size: 0.7rem !important;
}

.fw-medium {
    font-weight: 500 !important;
}

.alert {
    border-radius: 12px !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
}

.img-thumbnail {
    border-radius: 12px !important;
    border: 2px solid #e2e8f0 !important;
    transition: all var(--transition-speed) ease !important;
}

.img-thumbnail:hover {
    transform: scale(1.05) !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
}

.form-check-input:checked {
    background-color: var(--primary) !important;
    border-color: var(--primary) !important;
}

@media (max-width: 768px) {
    .d-flex.flex-md-row {
        flex-direction: column !important;
    }
    
    .btn {
        width: 100% !important;
        margin-bottom: 0.5rem;
    }
    
    .d-flex.justify-content-end.gap-2 {
        flex-direction: column;
    }
}
</style>