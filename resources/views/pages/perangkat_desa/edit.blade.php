@extends('layouts.admin.app')

@section('title', 'Edit Perangkat Desa')

@section('content')
<div class="container-fluid">
    <!-- Header dengan breadcrumb -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-edit text-primary"></i> Edit Perangkat Desa
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.perangkat_desa.index') }}">Perangkat Desa</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.perangkat_desa.show', $perangkatDesa->id) }}">Detail</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.perangkat_desa.show', $perangkatDesa->id) }}" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-eye"></i>
                </span>
                <span class="text">Lihat Detail</span>
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
        <!-- Form Edit -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-edit mr-2"></i>Form Edit Data Perangkat Desa
                    </h6>
                </div>
                <div class="card-body">
                    @include('pages.partials.alert')

                    <form action="{{ route('admin.perangkat_desa.update', $perangkatDesa->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Informasi Warga -->
                        <div class="form-section mb-4">
                            <h5 class="section-title">
                                <i class="fas fa-user mr-2 text-primary"></i>Informasi Warga
                            </h5>
                            <div class="form-group">
                                <label for="warga_id" class="font-weight-bold">Pilih Warga <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('warga_id') is-invalid @enderror" 
                                        id="warga_id" name="warga_id" required>
                                    <option value="">Pilih Warga</option>
                                    @foreach($wargas as $warga)
                                        <option value="{{ $warga->id }}" 
                                            {{ old('warga_id', $perangkatDesa->warga_id) == $warga->id ? 'selected' : '' }}
                                            data-nik="{{ $warga->nik }}"
                                            data-alamat="{{ $warga->alamat }}"
                                            data-tgl_lahir="{{ $warga->tgl_lahir->format('d/m/Y') }}"
                                            data-jenis_kelamin="{{ $warga->jenis_kelamin }}">
                                            {{ $warga->nama }} (NIK: {{ $warga->nik }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('warga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Preview Data Warga -->
                            <div id="wargaPreview" class="card bg-light mt-3" style="display: none;">
                                <div class="card-body">
                                    <h6 class="card-title">Informasi Warga Terpilih:</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small><strong>NIK:</strong> <span id="previewNik">-</span></small><br>
                                            <small><strong>Tanggal Lahir:</strong> <span id="previewTglLahir">-</span></small>
                                        </div>
                                        <div class="col-md-6">
                                            <small><strong>Jenis Kelamin:</strong> <span id="previewJenisKelamin">-</span></small><br>
                                            <small><strong>Alamat:</strong> <span id="previewAlamat">-</span></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Jabatan -->
                        <div class="form-section mb-4">
                            <h5 class="section-title">
                                <i class="fas fa-briefcase mr-2 text-primary"></i>Informasi Jabatan
                            </h5>
                            <div class="form-group">
                                <label for="jabatan" class="font-weight-bold">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                                       id="jabatan" name="jabatan" value="{{ old('jabatan', $perangkatDesa->jabatan) }}" 
                                       placeholder="Contoh: Kepala Desa, Sekretaris Desa, Bendahara" required>
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nip" class="font-weight-bold">NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror" 
                                               id="nip" name="nip" value="{{ old('nip', $perangkatDesa->nip) }}" 
                                               placeholder="Nomor Induk Pegawai">
                                        @error('nip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kontak" class="font-weight-bold">Kontak</label>
                                        <input type="text" class="form-control @error('kontak') is-invalid @enderror" 
                                               id="kontak" name="kontak" value="{{ old('kontak', $perangkatDesa->kontak) }}" 
                                               placeholder="Nomor telepon">
                                        @error('kontak')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Periode Jabatan -->
                        <div class="form-section mb-4">
                            <h5 class="section-title">
                                <i class="fas fa-calendar-alt mr-2 text-primary"></i>Periode Jabatan
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="periode_mulai" class="font-weight-bold">Periode Mulai <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('periode_mulai') is-invalid @enderror" 
                                               id="periode_mulai" name="periode_mulai" 
                                               value="{{ old('periode_mulai', $perangkatDesa->periode_mulai->format('Y-m-d')) }}" required>
                                        @error('periode_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="periode_selesai" class="font-weight-bold">Periode Selesai</label>
                                        <input type="date" class="form-control @error('periode_selesai') is-invalid @enderror" 
                                               id="periode_selesai" name="periode_selesai" 
                                               value="{{ old('periode_selesai', $perangkatDesa->periode_selesai ? $perangkatDesa->periode_selesai->format('Y-m-d') : '') }}">
                                        @error('periode_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            <i class="fas fa-info-circle mr-1"></i>Kosongkan jika masih aktif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Foto -->
                        <div class="form-section mb-4">
                            <h5 class="section-title">
                                <i class="fas fa-camera mr-2 text-primary"></i>Foto Profil
                            </h5>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="current-photo text-center">
                                            @if($perangkatDesa->foto)
                                                <img src="{{ Storage::url($perangkatDesa->foto) }}" alt="Foto saat ini" class="img-fluid rounded shadow mb-2 current-photo-img">
                                                <p class="text-muted small">Foto Saat Ini</p>
                                            @else
                                                <img src="{{ asset('assets/img/default-user.png') }}" alt="Default" class="img-fluid rounded shadow mb-2 current-photo-img">
                                                <p class="text-muted small">Foto Default</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="foto" class="font-weight-bold">Ubah Foto</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" 
                                                       id="foto" name="foto" accept="image/*">
                                                <label class="custom-file-label" for="foto" id="fotoLabel">Pilih file foto...</label>
                                                @error('foto')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Format: JPEG, PNG, JPG, GIF (Maks. 2MB). Kosongkan jika tidak ingin mengubah foto.
                                            </small>
                                        </div>

                                        <!-- Preview Foto Baru -->
                                        <div id="fotoPreview" class="mt-3 text-center" style="display: none;">
                                            <img id="previewImage" src="#" alt="Preview Foto" class="img-fluid rounded shadow mb-2 preview-photo-img">
                                            <p class="text-muted small">Preview Foto Baru</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary btn-lg btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Simpan Perubahan</span>
                            </button>
                            <button type="reset" class="btn btn-warning btn-lg btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-undo"></i>
                                </span>
                                <span class="text">Reset Form</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Informasi -->
        <div class="col-lg-4">
            <!-- Informasi Data Saat Ini -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-info">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Data Saat Ini
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if($perangkatDesa->foto)
                            <img src="{{ Storage::url($perangkatDesa->foto) }}" alt="Foto saat ini" class="img-fluid rounded-circle shadow profile-side-img">
                        @else
                            <img src="{{ asset('assets/img/default-user.png') }}" alt="Default" class="img-fluid rounded-circle shadow profile-side-img">
                        @endif
                        <h5 class="mt-3 font-weight-bold">{{ $perangkatDesa->warga->nama }}</h5>
                        <span class="badge badge-primary p-2">{{ $perangkatDesa->jabatan }}</span>
                    </div>
                    
                    <div class="info-list mt-4">
                        <div class="info-item">
                            <div class="info-label">NIK</div>
                            <div class="info-value">{{ $perangkatDesa->warga->nik }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">NIP</div>
                            <div class="info-value">{{ $perangkatDesa->nip ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Kontak</div>
                            <div class="info-value">{{ $perangkatDesa->kontak ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Periode Mulai</div>
                            <div class="info-value">{{ $perangkatDesa->periode_mulai->format('d/m/Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                @if($perangkatDesa->periode_selesai && $perangkatDesa->periode_selesai < now())
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                @else
                                    <span class="badge badge-success">Aktif</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panduan Pengisian -->
            <div class="card shadow">
                <div class="card-header py-3 bg-gradient-success">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-lightbulb mr-2"></i>Panduan Pengisian
                    </h6>
                </div>
                <div class="card-body">
                    <div class="tips-list">
                        <div class="tip-item">
                            <i class="fas fa-check-circle text-success mr-2"></i>
                            <span>Pastikan data warga sudah benar</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-check-circle text-success mr-2"></i>
                            <span>Isi jabatan sesuai struktur organisasi</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-check-circle text-success mr-2"></i>
                            <span>Periode mulai wajib diisi</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-check-circle text-success mr-2"></i>
                            <span>Foto maksimal 2MB dengan format JPG/PNG</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Set tanggal maksimum untuk input date
document.getElementById('periode_mulai').max = new Date().toISOString().split('T')[0];
document.getElementById('periode_selesai').max = new Date().toISOString().split('T')[0];

// Validasi tanggal selesai harus setelah tanggal mulai
document.getElementById('periode_mulai').addEventListener('change', function() {
    document.getElementById('periode_selesai').min = this.value;
});

document.getElementById('periode_selesai').addEventListener('change', function() {
    const periodeMulai = document.getElementById('periode_mulai').value;
    if (this.value && this.value <= periodeMulai) {
        alert('Tanggal selesai harus setelah tanggal mulai');
        this.value = '';
    }
});

// Set min date untuk periode_selesai berdasarkan nilai saat ini
document.addEventListener('DOMContentLoaded', function() {
    const periodeMulai = document.getElementById('periode_mulai').value;
    if (periodeMulai) {
        document.getElementById('periode_selesai').min = periodeMulai;
    }
});

// Preview foto yang dipilih
document.getElementById('foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('previewImage');
    const previewContainer = document.getElementById('fotoPreview');
    const label = document.getElementById('fotoLabel');
    
    if (file) {
        label.textContent = file.name;
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    } else {
        label.textContent = 'Pilih file foto...';
        previewContainer.style.display = 'none';
    }
});

// Preview data warga yang dipilih
document.getElementById('warga_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const previewContainer = document.getElementById('wargaPreview');
    
    if (this.value) {
        document.getElementById('previewNik').textContent = selectedOption.getAttribute('data-nik');
        document.getElementById('previewTglLahir').textContent = selectedOption.getAttribute('data-tgl_lahir');
        document.getElementById('previewJenisKelamin').textContent = selectedOption.getAttribute('data-jenis_kelamin');
        document.getElementById('previewAlamat').textContent = selectedOption.getAttribute('data-alamat');
        previewContainer.style.display = 'block';
    } else {
        previewContainer.style.display = 'none';
    }
});

// Inisialisasi preview warga jika sudah ada nilai
document.addEventListener('DOMContentLoaded', function() {
    const wargaSelect = document.getElementById('warga_id');
    if (wargaSelect.value) {
        wargaSelect.dispatchEvent(new Event('change'));
    }
});

// Custom file input
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var fileName = document.getElementById("foto").files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
});
</script>

<style>
.section-title {
    border-bottom: 2px solid #e3f2fd;
    padding-bottom: 10px;
    margin-bottom: 20px;
    color: #2e59d9;
    font-weight: 600;
}

.form-section {
    background: #f8f9fc;
    padding: 20px;
    border-radius: 10px;
    border-left: 4px solid #2e59d9;
    margin-bottom: 25px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.current-photo-img, .preview-photo-img {
    max-height: 200px;
    object-fit: cover;
}

.profile-side-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
}

.info-list {
    border-top: 1px solid #e3e6f0;
    padding-top: 15px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #f8f9fc;
}

.info-label {
    font-weight: 600;
    color: #5a5c69;
}

.info-value {
    color: #2e2f33;
}

.tips-list {
    padding-left: 0;
}

.tip-item {
    display: flex;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f8f9fc;
}

.tip-item:last-child {
    border-bottom: none;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #2e59d9) !important;
}

.bg-gradient-info {
    background: linear-gradient(45deg, #36b9cc, #17a2b8) !important;
}

.bg-gradient-success {
    background: linear-gradient(45deg, #1cc88a, #17a2b8) !important;
}

.btn-icon-split {
    border-radius: 8px;
    padding: 10px 20px;
}

.select2-container--default .select2-selection--single {
    border: 1px solid #d1d3e2;
    border-radius: 0.35rem;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: calc(1.5em + 0.75rem + 2px);
}

.card {
    border: none;
    border-radius: 10px;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
}
</style>

<!-- Include Select2 CSS & JS jika ingin menggunakan select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Pilih Warga",
        allowClear: true
    });
});
</script>
@endsection