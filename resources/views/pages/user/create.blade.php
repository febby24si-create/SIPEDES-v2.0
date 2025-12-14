@extends('layouts.admin.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-user-plus"></i> Tambah User Baru
    </h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Avatar -->
                <div class="form-group row mb-4">
                    <label class="col-md-3 col-form-label">Foto Profil</label>
                    <div class="col-md-9">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div id="avatarPreview" 
                                     style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; border: 3px solid #dee2e6;">
                                    <img src="https://ui-avatars.com/api/?name=User&color=7F9CF5&background=EBF4FF" 
                                         style="width: 100%; height: 100%; object-fit: cover;"
                                         id="previewImage">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <input type="file" 
                                       class="form-control" 
                                       name="avatar" 
                                       accept="image/*"
                                       onchange="previewImage(this)">
                                <small class="text-muted">Max: 2MB (JPG, PNG, JPEG)</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nama -->
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Lengkap *</label>
                    <div class="col-md-9">
                        <input type="text" 
                               class="form-control" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Email *</label>
                    <div class="col-md-9">
                        <input type="email" 
                               class="form-control" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Password *</label>
                    <div class="col-md-9">
                        <input type="password" 
                               class="form-control" 
                               name="password" 
                               required>
                        <small class="text-muted">Minimal 6 karakter</small>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Konfirmasi Password *</label>
                    <div class="col-md-9">
                        <input type="password" 
                               class="form-control" 
                               name="password_confirmation" 
                               required>
                    </div>
                </div>

                <!-- Role -->
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Role *</label>
                    <div class="col-md-9">
                        <select class="form-control" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                            <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                        </select>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="form-group row mt-4">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan User
                        </button>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
window.previewImage = function (input) {
    const file = input.files[0];
    if (!file) return;

    // Validasi size (2MB)
    if (file.size > 2 * 1024 * 1024) {
        alert('Ukuran gambar maksimal 2MB');
        input.value = '';
        return;
    }

    // Validasi tipe
    if (!file.type.match('image.*')) {
        alert('File harus berupa gambar');
        input.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('previewImage').src = e.target.result;
    };
    reader.readAsDataURL(file);
};
</script>

@endsection