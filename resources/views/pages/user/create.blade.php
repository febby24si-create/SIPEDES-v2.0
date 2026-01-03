@extends('layouts.admin.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
            <i class="fas fa-user-plus text-primary mr-2"></i>Tambah User Baru
        </h1>
        <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <div class="card shadow border-0 mb-4">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Identitas Pengguna</h6>
                </div>
                <div class="card-body px-lg-5 py-lg-4">
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-5 align-items-center bg-light p-3 rounded">
                            <div class="col-md-3 text-center mb-3 mb-md-0">
                                <div id="avatarPreview" class="mx-auto shadow-sm"
                                     style="width: 140px; height: 140px; border-radius: 50%; overflow: hidden; border: 4px solid #fff; transition: transform 0.3s ease;">
                                    <img src="https://ui-avatars.com/api/?name=User&color=7F9CF5&background=EBF4FF" 
                                         style="width: 100%; height: 100%; object-fit: cover;"
                                         id="previewImage">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <label class="font-weight-bold text-dark">Foto Profil</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="avatarInput" name="avatar" accept="image/*" onchange="previewImage(this)">
                                    <label class="custom-file-label" for="avatarInput">Pilih foto...</label>
                                </div>
                                <small class="text-muted mt-2 d-block">
                                    <i class="fas fa-info-circle mr-1"></i> Format: JPG, PNG, JPEG. Ukuran maksimal 2MB.
                                </small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="small font-weight-bold text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-user text-muted"></i></span>
                                        </div>
                                        <input type="text" class="form-control border-left-0 pl-0" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="small font-weight-bold text-dark">Alamat Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-envelope text-muted"></i></span>
                                        </div>
                                        <input type="email" class="form-control border-left-0 pl-0" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="small font-weight-bold text-dark">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-lock text-muted"></i></span>
                                        </div>
                                        <input type="password" class="form-control border-left-0 pl-0" name="password" placeholder="Min. 6 karakter" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="small font-weight-bold text-dark">Konfirmasi Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-shield-alt text-muted"></i></span>
                                        </div>
                                        <input type="password" class="form-control border-left-0 pl-0" name="password_confirmation" placeholder="Ulangi password" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <label class="small font-weight-bold text-dark">Role Akses <span class="text-danger">*</span></label>
                            <select class="form-control custom-select shadow-none" name="role" required>
                                <option value="" disabled selected>Pilih hak akses user...</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator (Akses Penuh)</option>
                                <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator (Input Data)</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Lihat Data Saja)</option>
                            </select>
                        </div>

                        <div class="text-right border-top pt-4">
                            <button type="reset" class="btn btn-light px-4 mr-2">Reset</button>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="fas fa-save mr-2"></i> Simpan Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styling untuk mempercantik */
    .form-control {
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1);
    }
    .input-group-text {
        border-radius: 8px 0 0 8px !important;
    }
    .input-group .form-control {
        border-radius: 0 8px 8px 0 !important;
    }
    #avatarPreview:hover {
        transform: scale(1.05);
    }
    .custom-file-label {
        border-radius: 8px;
    }
</style>

<script>
window.previewImage = function (input) {
    const file = input.files[0];
    if (!file) return;

    // Update label text
    const fileName = input.files[0].name;
    const label = input.nextElementSibling;
    label.innerText = fileName;

    // Validasi size (2MB)
    if (file.size > 2 * 1024 * 1024) {
        Swal.fire('Error', 'Ukuran gambar maksimal 2MB', 'error'); // Gunakan SweetAlert jika ada
        input.value = '';
        label.innerText = 'Pilih foto...';
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