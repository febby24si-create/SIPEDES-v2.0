@extends('layouts.admin.app')

@section('title', 'Jabatan Lembaga')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-tags"></i> Jabatan {{ $lembaga->nama_lembaga }}
    </h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Jabatan</h6>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('admin.lembaga.jabatan.create', $lembaga->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Jabatan
                    </a>
                    <a href="{{ route('admin.lembaga.anggota.index', $lembaga->id) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-users"></i> Kelola Anggota
                    </a>
                    <a href="{{ route('admin.lembaga.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($jabatans->isEmpty())
            <div class="text-center py-4">
                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada jabatan untuk lembaga ini.</p>
                <a href="{{ route('admin.lembaga.jabatan.create', $lembaga->id) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Jabatan Pertama
                </a>
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Jabatan</th>
                            <th>Level</th>
                            <th>Jumlah Anggota</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jabatans as $jabatan)
                        <tr>
                            <td>{{ $jabatan->nama_jabatan }}</td>
                            <td>
                                @switch($jabatan->level)
                                    @case('Ketua')
                                        <span class="badge badge-success">
                                            <i class="fas fa-crown"></i> {{ $jabatan->level }}
                                        </span>
                                        @break
                                    @case('Sekretaris')
                                        <span class="badge badge-info">
                                            <i class="fas fa-pen"></i> {{ $jabatan->level }}
                                        </span>
                                        @break
                                    @case('Bendahara')
                                        <span class="badge badge-warning">
                                            <i class="fas fa-money-bill"></i> {{ $jabatan->level }}
                                        </span>
                                        @break
                                    @case('Anggota')
                                        <span class="badge badge-secondary">
                                            <i class="fas fa-user"></i> {{ $jabatan->level }}
                                        </span>
                                        @break
                                    @default
                                        <span class="badge badge-dark">
                                            <i class="fas fa-star"></i> {{ $jabatan->level }}
                                        </span>
                                @endswitch
                            </td>
                            <td>
                                <span class="badge badge-primary">
                                    {{ $jabatan->anggotas_count ?? 0 }} Anggota
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.lembaga.jabatan.edit', [$lembaga->id, $jabatan->id]) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.lembaga.jabatan.destroy', [$lembaga->id, $jabatan->id]) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Hapus jabatan ini?')"
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
            @endif
        </div>
    </div>
</div>
@endsection