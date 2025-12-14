@extends('layouts.admin.app')

@section('title', 'Data RT')

@section('content')
<div class="container-fluid dashboard-body">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 dashboard-header">
            <i class="fas fa-map-marker-alt"></i> Data RT
        </h1>
        <a href="{{ route('admin.rt.create') }}" class="btn btn-primary dashboard-btn">
            <i class="fas fa-plus"></i> Tambah RT
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 dashboard-card">
        <div class="card-header py-3 dashboard-card-header">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-list"></i> Daftar RT
            </h6>
        </div>
        <div class="card-body">
            <form method="GET" class="mb-3">

                <div class="row">

                    <!-- Search -->
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control" placeholder="Cari RT / Ketua RT / RW...">
                    </div>

                    <!-- Filter RW -->
                    <div class="col-md-3">
                        <select name="filter_rw" class="form-control">
                            <option value="">-- Filter RW --</option>
                            @foreach($rws as $rw)
                            <option value="{{ $rw->id }}" {{ request('filter_rw') == $rw->id ? 'selected' : '' }}>
                                RW {{ $rw->nomor_rw }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Status -->
                    <div class="col-md-3">
                        <select name="filter_status" class="form-control">
                            <option value="">-- Filter Status --</option>
                            <option value="Aktif" {{ request('filter_status') == "Aktif" ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ request('filter_status') == "Nonaktif" ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>

                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>RW</th>
                            <th>Nomor RT</th>
                            <th>Ketua RT</th>
                            <th>Kontak</th>
                            <th>Jumlah Warga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rts as $rt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <span class="badge badge-primary">RW {{ $rt->rw->nomor_rw }}</span>
                            </td>
                            <td>
                                <strong>RT {{ $rt->nomor_rt }}</strong>
                            </td>
                            <td>{{ $rt->nama_ketua_rt }}</td>
                            <td>{{ $rt->kontak_rt ?? '-' }}</td>
                            <td>
                                <span class="badge badge-info">{{ $rt->wargas_count }} Warga</span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $rt->status == 'Aktif' ? 'success' : 'danger' }}">
                                    {{ $rt->status }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.rt.show', $rt->id) }}" 
                                       class="btn btn-info btn-sm" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.rt.edit', $rt->id) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.rt.destroy', $rt->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Hapus data RT?')"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($rts->isEmpty())
            <div class="text-center py-4">
                <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada data RT.</p>
                <a href="{{ route('admin.rt.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah RT Pertama
                </a>
            </div>
            @endif
            {{-- Pagination --}}
                @if($rts->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        Menampilkan {{ $rts->firstItem() }} hingga {{ $rts->lastItem() }} dari {{ $rts->total() }} hasil
                    </div>
                    {{ $rts->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
                @endif

        </div>
    </div>
</div>
@endsection