@extends('layouts.admin.app')

@section('title', 'Lembaga Desa')
@section('page_title', 'Lembaga Desa')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="fas fa-building me-2"></i>Lembaga Desa
            </h4>
            <small class="text-muted">Kelola data lembaga desa</small>
        </div>
        <a href="{{ route('admin.lembaga.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Lembaga
        </a>
    </div>

    {{-- FILTER --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.lembaga.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small">Cari</label>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Nama / deskripsi lembaga">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small">Urutkan</label>
                        <select name="sort" class="form-select">
                            @foreach([
                                'terbaru' => 'Terbaru',
                                'terlama' => 'Terlama',
                                'a-z' => 'Nama A-Z',
                                'z-a' => 'Nama Z-A',
                                'anggota_terbanyak' => 'Anggota Terbanyak',
                                'anggota_tersedikit' => 'Anggota Tersedikit'
                            ] as $key => $label)
                                <option value="{{ $key }}" @selected(request('sort') === $key)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i> Terapkan
                        </button>
                    </div>

                    <div class="col-md-2 d-grid">
                        <a href="{{ route('admin.lembaga.index') }}" class="btn btn-secondary">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card">
        <div class="card-body table-responsive">

            @if($lembagas->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-building fa-3x mb-3"></i>
                    <p class="mb-0">Belum ada data lembaga</p>
                </div>
            @else
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th width="80">Logo</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Anggota</th>
                            <th class="text-center">Jabatan</th>
                            <th>Kontak</th>
                            <th class="text-center" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lembagas as $lembaga)
                        <tr>
                            <td>{{ $loop->iteration + ($lembagas->firstItem() - 1) }}</td>

                            <td>
                                <img src="{{ $lembaga->logo 
                                    ? asset('storage/'.$lembaga->logo) 
                                    : asset('assets/img/default-lembaga.jpg') }}"
                                     class="rounded"
                                     width="50"
                                     height="50"
                                     style="object-fit:cover">
                            </td>

                            <td class="fw-bold">{{ $lembaga->nama_lembaga }}</td>

                            <td class="text-emphasis">
                                {{ Str::limit($lembaga->deskripsi, 80) }}
                            </td>

                            <td class="text-center">
                                <span class="badge bg-gray-300">
                                    {{ $lembaga->anggotas_count }}
                                </span>
                            </td>

                            <td class="text-center">
                                <span class="badge bg-gray-300">
                                    {{ $lembaga->jabatans_count }}
                                </span>
                            </td>

                            <td>
                                {{ $lembaga->kontak ?? '-' }}
                            </td>
                         <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.lembaga.show', $lembaga->id) }}" 
                                       class="btn btn-info btn-sm btn-glass" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.lembaga.edit', $lembaga->id) }}" 
                                       class="btn btn-warning btn-sm btn-glass" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.lembaga.destroy', $lembaga->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Hapus lembaga desa ini?')"
                                                class="btn btn-danger btn-sm btn-glass" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- PAGINATION --}}
    @if($lembagas->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-3">
        <small class="text-muted">
            Menampilkan {{ $lembagas->firstItem() }}–{{ $lembagas->lastItem() }}
            dari {{ $lembagas->total() }} data
        </small>
        {{ $lembagas->links('pagination::bootstrap-5') }}
    </div>
    @endif

</div>
@endsection
