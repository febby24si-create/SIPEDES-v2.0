@extends('layouts.admin.app')

@section('title', 'Tambah RT')

@section('content')
<div class="container-fluid dashboard-body">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 dashboard-header">
            <i class="fas fa-plus-circle"></i> Tambah Data RT
        </h1>
        <a href="{{ route('admin.rt.index') }}" class="btn btn-secondary dashboard-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4 dashboard-card">
        <div class="card-header py-3 dashboard-card-header">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-map-marker-alt"></i> Form Tambah RT
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.rt.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <!-- RW -->
                        <div class="form-group mb-4">
                            <label for="rw_id" class="form-label text-light">
                                <i class="fas fa-map-signs me-2"></i>RW *
                            </label>
                            <select class="form-control dashboard-input @error('rw_id') is-invalid @enderror" 
                                    id="rw_id" 
                                    name="rw_id"
                                    required>
                                <option value="">Pilih RW</option>
                                @foreach($rws as $rw)
                                    <option value="{{ $rw->id }}" {{ old('rw_id') == $rw->id ? 'selected' : '' }}>
                                        RW {{ $rw->nomor_rw }} - {{ $rw->nama_ketua_rw }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rw_id')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nomor RT -->
                        <div class="form-group mb-4">
                            <label for="nomor_rt" class="form-label text-light">
                                <i class="fas fa-hashtag me-2"></i>Nomor RT *
                            </label>
                            <input type="number" 
                                   class="form-control dashboard-input @error('nomor_rt') is-invalid @enderror" 
                                   id="nomor_rt" 
                                   name="nomor_rt" 
                                   value="{{ old('nomor_rt') }}" 
                                   min="1" 
                                   max="999"
                                   placeholder="Contoh: 1, 2, 3..."
                                   required>
                            @error('nomor_rt')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nama Ketua RT -->
                        <div class="form-group mb-4">
                            <label for="nama_ketua_rt" class="form-label text-light">
                                <i class="fas fa-user me-2"></i>Nama Ketua RT *
                            </label>
                            <input type="text" 
                                   class="form-control dashboard-input @error('nama_ketua_rt') is-invalid @enderror" 
                                   id="nama_ketua_rt" 
                                   name="nama_ketua_rt" 
                                   value="{{ old('nama_ketua_rt') }}" 
                                   placeholder="Nama lengkap ketua RT"
                                   required>
                            @error('nama_ketua_rt')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Kontak RT -->
                        <div class="form-group mb-4">
                            <label for="kontak_rt" class="form-label text-light">
                                <i class="fas fa-phone me-2"></i>Kontak RT
                            </label>
                            <input type="text" 
                                   class="form-control dashboard-input @error('kontak_rt') is-invalid @enderror" 
                                   id="kontak_rt" 
                                   name="kontak_rt" 
                                   value="{{ old('kontak_rt') }}" 
                                   placeholder="Nomor telepon/WA">
                            @error('kontak_rt')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Alamat RT -->
                        <div class="form-group mb-4">
                            <label for="alamat_rt" class="form-label text-light">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat RT
                            </label>
                            <textarea class="form-control dashboard-input @error('alamat_rt') is-invalid @enderror" 
                                      id="alamat_rt" 
                                      name="alamat_rt" 
                                      rows="3" 
                                      placeholder="Alamat lengkap RT">{{ old('alamat_rt') }}</textarea>
                            @error('alamat_rt')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-4">
                            <label for="status" class="form-label text-light">
                                <i class="fas fa-circle me-2"></i>Status *
                            </label>
                            <select class="form-control dashboard-input @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status"
                                    required>
                                <option value="">Pilih Status</option>
                                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="reset" class="btn btn-secondary dashboard-btn">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary dashboard-btn">
                                <i class="fas fa-save me-2"></i>Simpan RT
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection