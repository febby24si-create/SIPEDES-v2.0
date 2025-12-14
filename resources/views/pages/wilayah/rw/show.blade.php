@extends('layouts.admin.app')

@section('title', 'Detail RW')

@section('content')
<div class="container-fluid dashboard-body">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 dashboard-header">
            <i class="fas fa-eye"></i> Detail RW
        </h1>
        <div>
            <a href="{{ route('admin.rw.edit', $rw->id) }}" class="btn btn-warning dashboard-btn">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.rw.index') }}" class="btn btn-secondary dashboard-btn">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="card shadow mb-4 dashboard-card">
        <div class="card-header py-3 dashboard-card-header">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-info-circle"></i> Informasi RW
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nomor RW</th>
                            <td><strong class="text-primary">RW {{ $rw->nomor_rw }}</strong></td>
                        </tr>
                        <tr>
                            <th>Ketua RW</th>
                            <td>{{ $rw->nama_ketua_rw }}</td>
                        </tr>
                        <tr>
                            <th>Kontak</th>
                            <td>{{ $rw->kontak_rw ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge badge-{{ $rw->status == 'Aktif' ? 'success' : 'danger' }}">
                                    {{ $rw->status }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Jumlah RT</th>
                            <td>
                                <span class="badge badge-info">{{ $rw->rts_count }} RT</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Jumlah Warga</th>
                            <td>
                                <span class="badge badge-success">{{ $rw->wargas_count }} Warga</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>{{ $rw->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diupdate</th>
                            <td>{{ $rw->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Alamat -->
            <div class="row mt-3">
                <div class="col-12">
                    <h6><i class="fas fa-map-marker-alt"></i> Alamat RW</h6>
                    <div class="alert alert-light">
                        {{ $rw->alamat_rw ?? 'Alamat belum diisi' }}
                    </div>
                </div>
            </div>

            <!-- Daftar RT -->
            @if($rw->rts->count() > 0)
            <div class="row mt-4">
                <div class="col-12">
                    <h6><i class="fas fa-map-marker-alt"></i> Daftar RT di RW ini</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor RT</th>
                                    <th>Ketua RT</th>
                                    <th>Jumlah Warga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rw->rts as $rt)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>RT {{ $rt->nomor_rt }}</strong></td>
                                    <td>{{ $rt->nama_ketua_rt }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $rt->wargas_count }} Warga</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $rt->status == 'Aktif' ? 'success' : 'danger' }}">
                                            {{ $rt->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection