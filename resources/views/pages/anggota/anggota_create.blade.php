@extends('layouts.admin.app')

@section('title', 'Tambah Anggota Lembaga')

@section('content')
<div class="container-fluid">

    <!-- Header Section -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div class="mr-3">
                    <div class="bg-primary rounded-circle p-3 text-white shadow">
                        <i class="fas fa-user-plus fa-2x"></i>
                    </div>
                </div>
                <div>
                    <h1 class="h3 mb-1 text-gray-800 font-weight-bold">Tambah Anggota Lembaga</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-gray-600">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.lembaga.index') }}" class="text-decoration-none text-gray-600">Lembaga Desa</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.lembaga.anggota.index', $lembaga->id) }}" class="text-decoration-none text-gray-600">{{ $lembaga->nama_lembaga }}</a></li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Tambah Anggota</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('admin.lembaga.anggota.index', $lembaga->id) }}" class="btn btn-outline-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Anggota
            </a>
        </div>
    </div>

    <!-- Informasi Lembaga -->
    <div class="card border-left-info shadow mb-4">
        <div class="card-body py-3">
            <div class="row align-items-center">
                <div class="col-auto">
                    <i class="fas fa-info-circle fa-2x text-info"></i>
                </div>
                <div class="col ml-3">
                    <div class="text-xs font-weight-bold text-info text-uppercase">Lembaga</div>
                    <div class="mb-0 font-weight-bold text-gray-800">{{ $lembaga->nama_lembaga }}</div>
                    <small class="text-muted">{{ Str::limit($lembaga->deskripsi, 100) }}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Form Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user-edit mr-2"></i>Form Data Anggota
                    </h6>
                </div>
                <div class="card-body">
                    @include('pages.partials.alert')

                    <form action="{{ route('admin.lembaga.anggota.store', $lembaga->id) }}" method="POST" id="formAnggota">
                        @csrf
                        
                        <!-- Pilih Warga -->
                        <div class="form-group row">
                            <label for="warga_id" class="col-md-4 col-form-label text-md-right font-weight-bold">
                                Pilih Warga <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0">
                                            <i class="fas fa-user text-primary"></i>
                                        </span>
                                    </div>
                                    <select class="form-control @error('warga_id') is-invalid @enderror select2" 
                                            id="warga_id" name="warga_id" required
                                            data-placeholder="Cari dan pilih warga...">
                                        <option value=""></option>
                                        @foreach($wargas as $warga)
                                            <option value="{{ $warga->id }}" 
                                                {{ old('warga_id') == $warga->id ? 'selected' : '' }}
                                                data-nik="{{ $warga->nik }}"
                                                data-alamat="{{ $warga->alamat }}">
                                                {{ $warga->nama }} (NIK: {{ $warga->nik }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('warga_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted mt-2">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Pilih warga yang akan ditambahkan sebagai anggota lembaga
                                </small>
                                
                                <!-- Info Warga Terpilih -->
                                <div id="warga-info" class="mt-3 p-3 bg-light rounded d-none">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>NIK:</strong> <span id="info-nik">-</span>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Alamat:</strong> <span id="info-alamat">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jabatan -->
                        <div class="form-group row">
                            <label for="jabatan_id" class="col-md-4 col-form-label text-md-right font-weight-bold">
                                Jabatan <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-8">
                                @if($jabatans->isEmpty())
                                    <div class="alert alert-warning border-warning">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-triangle fa-2x text-warning mr-3"></i>
                                            <div>
                                                <h6 class="alert-heading mb-1">Belum ada jabatan!</h6>
                                                <p class="mb-0">Silakan buat jabatan terlebih dahulu sebelum menambahkan anggota.</p>
                                                <a href="{{ route('admin.lembaga.jabatan.index', $lembaga->id) }}" 
                                                   class="btn btn-warning btn-sm mt-2">
                                                    <i class="fas fa-cog mr-1"></i>Kelola Jabatan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <select class="form-control" disabled>
                                        <option>-- Tidak ada jabatan tersedia --</option>
                                    </select>
                                @else
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0">
                                                <i class="fas fa-briefcase text-primary"></i>
                                            </span>
                                        </div>
                                        <select class="form-control @error('jabatan_id') is-invalid @enderror" 
                                                id="jabatan_id" name="jabatan_id" required>
                                            <option value="">Pilih Jabatan</option>
                                            @foreach($jabatans as $jabatan)
                                                <option value="{{ $jabatan->id }}" 
                                                    {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}
                                                    data-level="{{ $jabatan->level }}">
                                                    {{ $jabatan->nama_jabatan }} - 
                                                    <span class="badge 
                                                        @if($jabatan->level == 'Ketua') badge-success
                                                        @elseif($jabatan->level == 'Sekretaris') badge-info
                                                        @elseif($jabatan->level == 'Bendahara') badge-warning
                                                        @else badge-secondary @endif">
                                                        {{ $jabatan->level }}
                                                    </span>
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jabatan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted mt-2">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Pilih jabatan yang sesuai untuk anggota ini
                                    </small>
                                @endif
                            </div>
                        </div>

                        <!-- Periode Menjabat -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right font-weight-bold">
                                Periode Menjabat <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_mulai" class="font-weight-bold text-dark">
                                                Tanggal Mulai
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0">
                                                        <i class="fas fa-calendar-alt text-primary"></i>
                                                    </span>
                                                </div>
                                                <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" 
                                                       id="tgl_mulai" name="tgl_mulai" 
                                                       value="{{ old('tgl_mulai', date('Y-m-d')) }}" required>
                                                @error('tgl_mulai')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_selesai" class="font-weight-bold text-dark">
                                                Tanggal Selesai
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0">
                                                        <i class="fas fa-calendar-times text-primary"></i>
                                                    </span>
                                                </div>
                                                <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" 
                                                       id="tgl_selesai" name="tgl_selesai" 
                                                       value="{{ old('tgl_selesai') }}">
                                                @error('tgl_selesai')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="form-text text-muted">
                                                <i class="fas fa-lightbulb mr-1"></i>
                                                Kosongkan jika masih aktif menjabat
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Status Indicator -->
                                <div id="status-indicator" class="mt-3 p-3 rounded d-none">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <span id="status-text"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-outline-secondary mr-2">
                                        <i class="fas fa-redo mr-2"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                                        <i class="fas fa-save mr-2"></i>Simpan Anggota
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Informasi -->
        <div class="col-lg-4">
            <!-- Card Panduan -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-lightbulb mr-2"></i>Panduan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="font-weight-bold text-primary mb-2">
                            <i class="fas fa-user-check mr-1"></i>Pemilihan Warga
                        </h6>
                        <p class="small text-muted mb-0">
                            Pastikan warga yang dipilih sudah terdaftar dalam database dan memenuhi syarat untuk menjadi anggota lembaga.
                        </p>
                    </div>
                    <div class="mb-3">
                        <h6 class="font-weight-bold text-primary mb-2">
                            <i class="fas fa-briefcase mr-1"></i>Penentuan Jabatan
                        </h6>
                        <p class="small text-muted mb-0">
                            Pilih jabatan yang sesuai dengan kemampuan dan tanggung jawab warga. Pastikan struktur organisasi tetap seimbang.
                        </p>
                    </div>
                    <div class="mb-0">
                        <h6 class="font-weight-bold text-primary mb-2">
                            <i class="fas fa-calendar mr-1"></i>Periode Menjabat
                        </h6>
                        <p class="small text-muted mb-0">
                            Atur periode menjabat dengan jelas. Status aktif akan ditentukan berdasarkan tanggal mulai dan selesai.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card Status -->
            <div class="card shadow border-left-primary">
                <div class="card-body">
                    <h6 class="font-weight-bold text-primary mb-3">
                        <i class="fas fa-chart-bar mr-2"></i>Statistik Cepat
                    </h6>
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="border rounded p-2 bg-light">
                                <div class="text-xs font-weight-bold text-primary text-uppercase">Total Anggota</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anggotas_count ?? 0 }}</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="border rounded p-2 bg-light">
                                <div class="text-xs font-weight-bold text-success text-uppercase">Aktif</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $aktif_count ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Select2 for warga selection
        if ($('.select2').length) {
            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: 'Cari dan pilih warga...'
            });
        }

        // Set tanggal maksimum untuk input date
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tgl_mulai').max = today;
        document.getElementById('tgl_selesai').max = today;

        // Show warga info when selected
        const wargaSelect = document.getElementById('warga_id');
        const wargaInfo = document.getElementById('warga-info');
        const infoNik = document.getElementById('info-nik');
        const infoAlamat = document.getElementById('info-alamat');

        wargaSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                const nik = selectedOption.getAttribute('data-nik');
                const alamat = selectedOption.getAttribute('data-alamat');
                
                infoNik.textContent = nik || '-';
                infoAlamat.textContent = alamat || '-';
                wargaInfo.classList.remove('d-none');
            } else {
                wargaInfo.classList.add('d-none');
            }
        });

        // Validasi tanggal
        const tglMulai = document.getElementById('tgl_mulai');
        const tglSelesai = document.getElementById('tgl_selesai');
        const statusIndicator = document.getElementById('status-indicator');
        const statusText = document.getElementById('status-text');

        function updateStatusIndicator() {
            const mulai = tglMulai.value;
            const selesai = tglSelesai.value;
            
            if (!mulai) {
                statusIndicator.classList.add('d-none');
                return;
            }

            if (selesai && selesai <= mulai) {
                statusIndicator.className = 'mt-3 p-3 rounded bg-danger text-white';
                statusText.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i> Tanggal selesai harus setelah tanggal mulai';
                statusIndicator.classList.remove('d-none');
            } else if (selesai && new Date(selesai) < new Date()) {
                statusIndicator.className = 'mt-3 p-3 rounded bg-warning text-dark';
                statusText.innerHTML = '<i class="fas fa-clock mr-1"></i> Status: Tidak Aktif (periode telah berakhir)';
                statusIndicator.classList.remove('d-none');
            } else if (selesai) {
                statusIndicator.className = 'mt-3 p-3 rounded bg-info text-white';
                statusText.innerHTML = '<i class="fas fa-calendar-check mr-1"></i> Status: Akan berakhir pada ' + new Date(selesai).toLocaleDateString('id-ID');
                statusIndicator.classList.remove('d-none');
            } else {
                statusIndicator.className = 'mt-3 p-3 rounded bg-success text-white';
                statusText.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Status: Aktif (masih menjabat)';
                statusIndicator.classList.remove('d-none');
            }
        }

        tglMulai.addEventListener('change', function() {
            tglSelesai.min = this.value;
            updateStatusIndicator();
        });

        tglSelesai.addEventListener('change', function() {
            updateStatusIndicator();
        });

        // Initialize status indicator
        updateStatusIndicator();

        // Form submission handler
        const form = document.getElementById('formAnggota');
        const btnSubmit = document.getElementById('btnSubmit');

        if (form) {
            form.addEventListener('submit', function(e) {
                // Basic validation
                const wargaId = document.getElementById('warga_id').value;
                const jabatanId = document.getElementById('jabatan_id').value;
                const tglMulai = document.getElementById('tgl_mulai').value;

                if (!wargaId || !jabatanId || !tglMulai) {
                    e.preventDefault();
                    alert('Harap lengkapi semua field yang wajib diisi!');
                    return false;
                }

                // Show loading state
                if (btnSubmit) {
                    btnSubmit.disabled = true;
                    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                }

                return true;
            });
        }

        // Trigger change event for warga select if there's old value
        @if(old('warga_id'))
            setTimeout(() => {
                wargaSelect.dispatchEvent(new Event('change'));
            }, 100);
        @endif
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
    
    .select2-container--bootstrap4 .select2-selection--single {
        height: calc(1.5em + 0.75rem + 2px);
        border: 1px solid #d1d3e2;
    }
    
    .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
        line-height: calc(1.5em + 0.75rem);
    }
    
    .card-header {
        border-bottom: 1px solid #e3e6f0;
    }
    
    .form-group.row {
        margin-bottom: 1.5rem;
    }
    
    .input-group-text {
        background-color: #f8f9fc;
        border: 1px solid #d1d3e2;
        border-right: none;
    }
    
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    /* Custom badge styles in select options */
    .select2-results__option .badge {
        font-size: 0.7em;
        margin-left: 5px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .form-group.row .col-form-label {
            text-align: left !important;
            margin-bottom: 0.5rem;
        }
        
        .d-flex.justify-content-end {
            justify-content: flex-start !important;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
    }
</style>
@endpush