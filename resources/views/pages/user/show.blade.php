@extends('layouts.admin.app')

@section('title', 'Detail User')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-user"></i> Detail User
    </h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Lengkap User</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Kolom kiri: Data User -->
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Nama</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                @if($user->role == 'admin')
                                    <span class="badge badge-success">
                                        <i class="fas fa-crown"></i> Administrator
                                    </span>
                                @else
                                    <span class="badge badge-info">
                                        <i class="fas fa-user"></i> Operator
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($user->id === auth()->id())
                                    <span class="badge badge-primary">
                                        <i class="fas fa-user"></i> Akun Anda
                                    </span>
                                @else
                                    <span class="badge badge-success">Aktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Diupdate</th>
                            <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                
                <!-- Kolom kanan: Avatar -->
                <div class="col-md-4 text-center">
                    <div class="mb-4">
                        <img src="{{ $user->avatar_url }}"
                             class="rounded-circle border shadow"
                             style="width: 200px; height: 200px; object-fit: cover;"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF'">
                    </div>
                    <div class="mt-3">
                        @if($user->avatar)
                            <p class="text-success mb-1">
                                <i class="fas fa-check-circle"></i> Memiliki foto profil
                            </p>
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> 
                                Klik edit untuk mengganti foto
                            </small>
                        @else
                            <p class="text-muted mb-1">
                                <i class="fas fa-user-circle"></i> Menggunakan avatar default
                            </p>
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> 
                                Klik edit untuk menambahkan foto
                            </small>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Informasi Keamanan:</strong> 
                        @if($user->id === auth()->id())
                            Ini adalah akun Anda sendiri. Pastikan untuk menjaga kerahasiaan password.
                        @else
                            Anda sedang melihat data user lain. Hati-hati dalam melakukan perubahan.
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 text-right">
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit User
                    </a>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection