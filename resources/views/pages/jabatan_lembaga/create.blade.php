@extends('layouts.admin.app')

@section('title', 'Tambah Jabatan Lembaga')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-plus-circle"></i> Tambah Jabatan {{ $lembaga->nama_lembaga }}
    </h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.lembaga.jabatan.store', $lembaga->id) }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nama_jabatan">Nama Jabatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" 
                           id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}" 
                           placeholder="Contoh: Ketua, Sekretaris, Bendahara" required>
                    @error('nama_jabatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="level">Level Jabatan <span class="text-danger">*</span></label>
                    <select class="form-control @error('level') is-invalid @enderror" 
                            id="level" name="level" required>
                        <option value="">Pilih Level Jabatan</option>
                        <option value="Ketua" {{ old('level') == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                        <option value="Sekretaris" {{ old('level') == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                        <option value="Bendahara" {{ old('level') == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                        <option value="Anggota" {{ old('level') == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                        <option value="Lainnya" {{ old('level') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Jabatan
                    </button>
                    <a href="{{ route('admin.lembaga.jabatan.index', $lembaga->id) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection