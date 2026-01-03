@extends('layouts.admin.app')

@section('content')
<div class="main-content-inner p-3 p-md-4"> 
    <div class="container-fluid">
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">Tambah Lembaga Desa</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dashboard</a></li>
                                <li class="breadcrumb-item active">Tambah Lembaga</li>
                            </ol>
                        </nav>
                    </div>
                    <a href="{{ route('admin.lembaga.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.lembaga.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4"> <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark">Nama Lembaga <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white border-0"><i class="fas fa-landmark"></i></span>
                                    <input type="text" name="nama_lembaga" class="form-control" placeholder="Masukkan nama lembaga..." required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark">Kontak Lembaga</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white border-0"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="kontak" class="form-control" placeholder="Nomor Telepon/Email">
                                </div>
                            </div>

                            <div class="mb-0">
                                <label class="form-label fw-bold text-dark">Deskripsi <span class="text-danger">*</span></label>
                                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="8" placeholder="Tulis deskripsi di sini..." required></textarea>
                                <div class="d-flex justify-content-between mt-2">
                                    <small class="text-dark">Minimal 50 karakter</small>
                                    <small id="deskripsi-counter" class="fw-bold text-muted">0 karakter</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <label class="form-label fw-bold text-dark mb-3">Logo Lembaga</label>
                            <div id="preview-container" class="bg-light rounded-3 d-flex flex-column align-items-center justify-content-center mb-3 border border-2 border-dashed" style="height: 200px;">
                                <img id="preview-image" src="#" class="img-fluid rounded d-none" style="max-height: 180px;">
                                <div id="placeholder-icon" class="text-center">
                                    <i class="fas fa-landmark fa-3x text-muted mb-2"></i>
                                    <p class="text-muted small mb-0">Belum ada logo</p>
                                </div>
                            </div>
                            <input type="file" name="logo" class="form-control form-control-sm" onchange="previewLogo(this)" accept="image/*">
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <label class="form-label fw-bold text-dark mb-3">Dokumen Tambahan</label>
                            <input type="file" name="dokumen[]" class="form-control" multiple>
                            <small class="text-muted d-block mt-2 small">Format: PDF, JPG, PNG (Maks 10MB)</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4 mb-5">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-dark border px-4">Reset</button>
                            <button type="submit" class="btn btn-primary fw-bold">
                                <i class="fas fa-save me-2"></i>Simpan Lembaga
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Tambahkan CSS ini untuk memberi jarak aman dari sidebar */
    .main-content-inner {
        margin-left: 0; /* Sesuaikan jika sidebar Anda fixed */
        transition: all 0.3s;
    }
    
    .border-dashed { border-style: dashed !important; border-color: #ced4da !important; }
    .form-label { color: #333 !important; }
    .input-group-text { width: 45px; justify-content: center; }
</style>

<script>
    // Preview Logo
    function previewLogo(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('preview-image').classList.remove('d-none');
                document.getElementById('placeholder-icon').classList.add('d-none');
            }
            reader.readAsDataURL(file);
        }
    }

    // Counter Deskripsi
    document.getElementById('deskripsi').addEventListener('input', function() {
        const length = this.value.length;
        const counter = document.getElementById('deskripsi-counter');
        counter.innerText = length + ' karakter';
        counter.className = length < 50 ? 'fw-bold text-danger' : 'fw-bold text-success';
    });
</script>
@endsection