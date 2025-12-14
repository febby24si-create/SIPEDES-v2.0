@extends('layouts.admin.app')

@section('title', 'Detail RT')

@section('content')
<div class="container-fluid dashboard-body">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 dashboard-header">
            <i class="fas fa-eye"></i> Detail RT
        </h1>
        <div>
            <a href="{{ route('admin.rt.edit', $rt->id) }}" class="btn btn-warning dashboard-btn">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.rt.index') }}" class="btn btn-secondary dashboard-btn">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="card shadow mb-4 dashboard-card">
        <div class="card-header py-3 dashboard-card-header">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-info-circle"></i> Informasi RT
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">RW</th>
                            <td>
                                <span class="badge badge-primary">RW {{ $rt->rw->nomor_rw }}</span>
                                - {{ $rt->rw->nama_ketua_rw }}
                            </td>
                        </tr>
                        <tr>
                            <th>Nomor RT</th>
                            <td><strong>RT {{ $rt->nomor_rt }}</strong></td>
                        </tr>
                        <tr>
                            <th>Ketua RT</th>
                            <td>{{ $rt->nama_ketua_rt }}</td>
                        </tr>
                        <tr>
                            <th>Kontak</th>
                            <td>{{ $rt->kontak_rt ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Status</th>
                            <td>
                                <span class="badge badge-{{ $rt->status == 'Aktif' ? 'success' : 'danger' }}">
                                    {{ $rt->status }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Jumlah Warga</th>
                            <td>
                                <span class="badge badge-info">{{ $rt->wargas_count }} Orang</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>{{ $rt->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diupdate</th>
                            <td>{{ $rt->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Alamat -->
            <div class="row mt-3">
                <div class="col-12">
                    <h6><i class="fas fa-map-marker-alt"></i> Alamat RT</h6>
                    <div class="alert alert-light">
                        {{ $rt->alamat_rt ?? 'Alamat belum diisi' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection