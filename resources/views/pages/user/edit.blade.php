@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-edit"></i> Edit User
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
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Avatar -->
                <div class="form-group row mb-4">
                    <label class="col-md-3 col-form-label">Foto Profil</label>
                    <div class="col-md-9">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div id="avatarPreview" 
                                     style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; border: 3px solid #dee2e6;">
                                    <img src="{{ $user->avatar_url }}" 
                                         style="width: 100%; height: 100%; object-fit: cover;"
                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF'">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <input type="file" 
                                       class="form-control" 
                                       name="avatar" 
                                       accept="image/*"
                                       onchange="previewImage(this)">
                                <small class="text-muted">Max: 2MB (JPG, PNG, JPEG)</small>
                                
                                @if($user->avatar)
                                <div class="form-check mt-2">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           id="remove_avatar" 
                                           name="remove_avatar" 
                                           value="1">
                                    <label class="form-check-label text-danger" for="remove_avatar">
                                        <i class="fas fa-trash"></i> Hapus foto profil
                                    </label>
                                </div>
                                @endif
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
                               value="{{ old('name', $user->name) }}" 
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
                               value="{{ old('email', $user->email) }}" 
                               required>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Password</label>
                    <div class="col-md-9">
                        <input type="password" 
                               class="form-control" 
                               name="password" 
                               placeholder="Kosongkan jika tidak ingin mengubah">
                        <small class="text-muted">Minimal 6 karakter</small>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Konfirmasi Password</label>
                    <div class="col-md-9">
                        <input type="password" 
                               class="form-control" 
                               name="password_confirmation" 
                               placeholder="Ulangi password">
                    </div>
                </div>

                <!-- Role -->
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Role *</label>
                    <div class="col-md-9">
                        <select class="form-control" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                            <option value="operator" {{ old('role', $user->role) == 'operator' ? 'selected' : '' }}>Operator</option>
                        </select>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="form-group row mt-4">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
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
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('avatarPreview').innerHTML = 
                '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection