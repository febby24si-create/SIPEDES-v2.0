<!-- resources/views/warga/index.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Data Warga')
@section('page_title', 'DATA SIPEDES')
@section('content')

    <h1 class="h3 mb-4" style="color: #000000;">
       <i class="fas fa-users"></i> Data Warga
    </h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="h4 mb-0 text-gray-800">Daftar Warga</h6>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('admin.warga.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Warga
                    </a>

                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Form Pencarian dan Filter -->
            <form action="{{ route('admin.warga.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <!-- Search Input -->
                    <div class="col-md-3 mb-2">
                        <input type="text" class="form-control" placeholder="Cari nama, NIK, alamat..." 
                               name="search" value="{{ request('search') }}">
                    </div>
                    
                    <!-- RW Filter -->
                    <div class="col-md-2 mb-2">
                        <select name="rw_filter" class="form-control">
                            <option value="">Semua RW</option>
                            @foreach($rws as $rw)
                                <option value="{{ $rw->id }}" {{ request('rw_filter') == $rw->id ? 'selected' : '' }}>
                                    {{ $rw->nomor_rw_formatted }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- RT Filter -->
                    <div class="col-md-2 mb-2">
                        <select name="rt_filter" class="form-control">
                            <option value="">Semua RT</option>
                            @foreach($rts as $rt)
                                <option value="{{ $rt->id }}" {{ request('rt_filter') == $rt->id ? 'selected' : '' }}>
                                    {{ $rt->nomor_rt_formatted }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Jenis Kelamin Filter -->
                    <div class="col-md-2 mb-2">
                        <select name="jk_filter" class="form-control">
                            <option value="">Semua JK</option>
                            <option value="Laki-laki" {{ request('jk_filter') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ request('jk_filter') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    
                    <!-- Status Filter -->
                    <div class="col-md-2 mb-2">
                        <select name="status_filter" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="ketua" {{ request('status_filter') == 'ketua' ? 'selected' : '' }}>Ketua RT/RW</option>
                            <option value="warga" {{ request('status_filter') == 'warga' ? 'selected' : '' }}>Warga Biasa</option>
                        </select>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="col-md-1 mb-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>
                
                <div class="row mt-2">
                    <div class="col-md-12">
                        <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-redo"></i> Reset Filter
                        </a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>RT/RW</th>
                            <th>Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wargas as $warga)
                        <tr>
                            <td>
                                <span class="font-weight-bold text-primary">{{ $warga->nik }}</span>
                            </td>
                            <td>
                                <strong>{{ $warga->nama }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($warga->alamat, 50) }}</small>
                            </td>
                            <td>
                                <span class="badge badge-dark">
                                    {{ $warga->tgl_lahir->format('d/m/Y') }}
                                </span>
                                <br>
                                <small class="text-muted">Usia: {{ $warga->tgl_lahir->age }} tahun</small>
                            </td>
                            <td>
                                @if($warga->jenis_kelamin == 'Laki-laki')
                                    <span class="badge badge-primary">
                                        <i class="fas fa-male"></i> Laki-laki
                                    </span>
                                @else
                                    <span class="badge badge-pink">
                                        <i class="fas fa-female"></i> Perempuan
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($warga->rt && $warga->rw)
                                    <span class="badge badge-info">RT {{ $warga->rt->nomor_rt }}</span>
                                    <span class="badge badge-secondary">RW {{ $warga->rw->nomor_rw }}</span>
                                @else
                                    <span class="badge badge-warning">Belum Ditentukan</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $isKetua = $warga->id == optional($warga->rw)->ketua_rw_warga_id || 
                                             $warga->id == optional($warga->rt)->ketua_rt_warga_id;
                                @endphp
                                @if($isKetua)
                                    <span class="badge badge-success">
                                        <i class="fas fa-star"></i> Ketua
                                    </span>
                                @else
                                    <span class="badge badge-dark">Warga</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.warga.show', $warga->id) }}" 
                                       class="btn btn-info btn-sm" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.warga.edit', $warga->id) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.warga.destroy', $warga->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Apakah Anda yakin menghapus data ini?')"
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

            <!-- Pagination -->
            @if($wargas->hasPages())
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Menampilkan {{ $wargas->firstItem() }} hingga {{ $wargas->lastItem() }} dari {{ $wargas->total() }} results
                </div>
                {{ $wargas->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
</div>
@endsection