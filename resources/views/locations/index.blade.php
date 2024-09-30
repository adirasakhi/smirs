@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Monitoring Inventaris</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Monitoring Inventaris</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Monitoring Inventaris Berdasarkan Lokasi</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nama Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $location)
                            <tr>
                                <td>{{ $location->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <a href="{{ route('item_checks.create', $location->id) }}" class="btn btn-primary me-1 mb-1">
                                            <i class="bi bi-list-check"></i>
                                        </a>
                                        <a href="{{ route('item_checks.history', $location->id) }}" class="btn btn-info me-1 mb-1">
                                            <i class="bi bi-clock-history"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
