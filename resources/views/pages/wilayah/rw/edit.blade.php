@extends('layouts.admin.app')

@section('title', 'Edit RW')

@section('content')
<div class="container-fluid dashboard-body">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 dashboard-header">
            <i class="fas fa-edit"></i> Edit Data RW
        </h1>
        <a href="{{ route('admin.rw.index') }}" class="btn btn-secondary dashboard-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4 dashboard-card">
        <div class="card-header py-3 dashboard-card-header">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-map-signs"></i> Form Edit RW
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.rw.update', $rw->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <!-- Nomor RW -->
                        <div class="form-group mb-4">
                            <label for="nomor_rw" class="form-label text-light">
                                <i class="fas fa-hashtag me-2"></i>Nomor RW *
                            </label>
                            <input type="number" 
                                   class="form-control dashboard-input @error('nomor_rw') is-invalid @enderror" 
                                   id="nomor_rw" 
                                   name="nomor_rw" 
                                   value="{{ old('nomor_rw', $rw->nomor_rw) }}" 
                                   min="1" 
                                   max="99"
                                   placeholder="Contoh: 1, 2, 3..."
                                   required>
                            @error('nomor_rw')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nama Ketua RW -->
                        <div class="form-group mb-4">
                            <label for="nama_ketua_rw" class="form-label text-light">
                                <i class="fas fa-user me-2"></i>Nama Ketua RW *
                            </label>
                            <input type="text" 
                                   class="form-control dashboard-input @error('nama_ketua_rw') is-invalid @enderror" 
                                   id="nama_ketua_rw" 
                                   name="nama_ketua_rw" 
                                   value="{{ old('nama_ketua_rw', $rw->nama_ketua_rw) }}" 
                                   placeholder="Nama lengkap ketua RW"
                                   required>
                            @error('nama_ketua_rw')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Kontak RW -->
                        <div class="form-group mb-4">
                            <label for="kontak_rw" class="form-label text-light">
                                <i class="fas fa-phone me-2"></i>Kontak RW
                            </label>
                            <input type="text" 
                                   class="form-control dashboard-input @error('kontak_rw') is-invalid @enderror" 
                                   id="kontak_rw" 
                                   name="kontak_rw" 
                                   value="{{ old('kontak_rw', $rw->kontak_rw) }}" 
                                   placeholder="Nomor telepon/WA">
                            @error('kontak_rw')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Alamat RW -->
                        <div class="form-group mb-4">
                            <label for="alamat_rw" class="form-label text-light">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat RW
                            </label>
                            <textarea class="form-control dashboard-input @error('alamat_rw') is-invalid @enderror" 
                                      id="alamat_rw" 
                                      name="alamat_rw" 
                                      rows="3" 
                                      placeholder="Alamat lengkap RW">{{ old('alamat_rw', $rw->alamat_rw) }}</textarea>
                            @error('alamat_rw')
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
                                <option value="Aktif" {{ old('status', $rw->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ old('status', $rw->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Informasi Data -->
                <div class="alert alert-info mt-3">
                    <h6><i class="fas fa-info-circle"></i> Informasi Data</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <small><strong>Jumlah RT:</strong> {{ $rw->rts_count ?? 0 }}</small><br>
                            <small><strong>Jumlah Warga:</strong> {{ $rw->wargas_count ?? 0 }}</small>
                        </div>
                        <div class="col-md-6">
                            <small><strong>Dibuat:</strong> {{ $rw->created_at->format('d/m/Y H:i') }}</small><br>
                            <small><strong>Diupdate:</strong> {{ $rw->updated_at->format('d/m/Y H:i') }}</small>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.rw.index') }}" class="btn btn-secondary dashboard-btn">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary dashboard-btn">
                                <i class="fas fa-save me-2"></i>Update RW
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection