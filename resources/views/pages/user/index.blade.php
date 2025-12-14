@extends('layouts.admin.app')

@section('title', 'Manajemen User')
@section('page_title', 'INFORMASI USER')

@section('content')
<div class="container-fluid dashboard-body py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-11">
            <!-- Page Header -->
            <div class="d-sm-flex align-items-center justify-content-between mb-5">
                <div>
                    <h1 class="h2 mb-1 dashboard-text-primary">
                        <i class="fas fa-users me-2"></i>Manajemen User
                    </h1>
                    <p class="text-muted mb-0">Kelola pengguna dan akses sistem</p>
                </div>
                <div>
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah User
                    </a>
                </div>
            </div>
            <!-- Quick Stats -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-left-primary h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <i class="fas fa-users fa-2x text-primary"></i>
                                </div>
                                <div class="col-9">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Users
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $users->total() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-left-success h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <i class="fas fa-crown fa-2x text-success"></i>
                                </div>
                                <div class="col-9">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Administrator
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $users->where('role', 'admin')->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-left-info h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <i class="fas fa-user fa-2x text-info"></i>
                                </div>
                                <div class="col-9">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Operator
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $users->where('role', 'operator')->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Card -->
            <div class="card shadow-lg mb-4">
                <div class="card-header py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0 text-dark-rgb">
                                <i class="fas fa-list me-2"></i>Daftar User Sistem
                            </h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="badge badge-primary stats-badge">
                                Total: {{ $users->total() }} User
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Search & Filter Form -->
                    <form action="{{ route('admin.user.index') }}" method="GET" class="search-form mb-4">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label small text-muted mb-1">Pencarian</label>
                                <input type="text" 
                                    class="form-control" 
                                    placeholder="Cari nama atau email..."
                                    name="search" 
                                    value="{{ request('search') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small text-muted mb-1">Filter Role</label>
                                <select name="role" class="form-control">
                                    <option value="">Semua Role</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="operator" {{ request('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small text-muted mb-1">&nbsp;</label>
                                <div class="d-grid gap-2 d-md-flex">
                                    <button type="submit" class="btn btn-primary flex-fill">
                                        <i class="fas fa-search me-2"></i>Cari
                                    </button>
                                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary flex-fill">
                                        <i class="fas fa-refresh me-2"></i>Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Users Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="50">Logo</th>
                                    <th>User</th>
                                    <th>Kontak</th>
                                    <th>Role</th>
                                    <th>Bergabung</th>
                                    <th>Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
<td class="text-center">
    <div class="position-relative d-inline-block">
        <img src="{{ $user->avatar_url }}"
             class="rounded-circle"
             style="width:45px;height:45px;object-fit:cover;cursor:pointer;border:1px solid #000000;"
             onclick="window.location.href='{{ route('admin.user.show', $user->id) }}'"
             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF'">
        
        <span class="position-absolute top-0 start-100 translate-middle badge {{ $user->role == 'admin' ? 'bg-success' : 'bg-info' }}"
              style="font-size:0.6rem;padding:2px 5px;border:2px solid #000000;">
            {{ $user->role == 'admin' ? 'A' : 'O' }}
        </span>
    </div>
</td>
                                            
                                            <!-- Role Badge on Logo -->
                                            <span class="position-absolute top-0 start-100 translate-middle badge {{ $user->role == 'admin' ? 'bg-success' : 'bg-info' }}"
                                                  style="font-size: 0.6rem; padding: 2px 5px; border: 2px solid #000000;">
                                                {{ $user->role == 'admin' ? 'A' : 'O' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 ms-3">
                                                <strong class="text-gray-900">{{ $user->name }}</strong>
                                                <div class="small text-muted">ID: {{ $user->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small text-muted">{{ $user->email }}</div>
                                        <div class="small">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $user->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->role == 'admin')
                                            <span class="--bs-blue">
                                                <i class="fas fa-crown"></i>Administrator
                                            </span>
                                        @else
                                            <span class="badge badge-info stats-badge">
                                                <i class="fas fa-user me-1"></i>Operator
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-dark stats-badge">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $user->created_at->format('d/m/Y') }}
                                        </span>
                                        <div class="small text-muted mt-1">
                                            {{ $user->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->id === auth()->id())
                                            <span class="badge badge-primary stats-badge">
                                                <i class="fas fa-star me-1"></i>Anda
                                            </span>
                                        @else
                                            <span class="badge badge-success ">
                                                <i class="fas fa-check-circle me-1"></i>Aktif
                                            </span> 
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons d-flex justify-content-center">
                                            <a href="{{ route('admin.user.show', $user->id) }}" 
                                               class="btn btn-info btn-sm" 
                                               title="Detail User"
                                               data-bs-toggle="tooltip">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.user.edit', $user->id) }}" 
                                               class="btn btn-warning btn-sm" 
                                               title="Edit User"
                                               data-bs-toggle="tooltip">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.user.destroy', $user->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm" 
                                                        onclick="return confirmDelete('{{ $user->name }}')"
                                                        title="Hapus User"
                                                        data-bs-toggle="tooltip">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @else
                                            <button class="btn btn-danger btn-sm" 
                                                    disabled 
                                                    title="Tidak dapat menghapus akun sendiri"
                                                    data-bs-toggle="tooltip">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-users fa-2x mb-3"></i>
                                            <p>Tidak ada data user ditemukan</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($users->hasPages())
                    <div class="pagination-container">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="page-info">
                                    Menampilkan <strong>{{ $users->firstItem() }}</strong> sampai 
                                    <strong>{{ $users->lastItem() }}</strong> dari 
                                    <strong>{{ $users->total() }}</strong> user
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    {{ $users->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection