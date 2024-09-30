@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Riwayat Pengecekan Barang di Lokasi: {{ $location->name }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">History Inventaris</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Riwayat Pengecekan Barang</h4>
                <div class="text-end">
                    <a href="{{ route('admin.locations.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Di Cek Oleh</th>
                            <th>Waktu Cek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($itemChecks as $check)
                            <tr>
                                <td>{{ $check->inventory->name }}</td>
                                <td>{{ ucfirst($check->status) }}</td>
                                <td>{{ $check->description }}</td>
                                <td>{{ $check->user->name }}</td>
                                <td>{{ $check->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
