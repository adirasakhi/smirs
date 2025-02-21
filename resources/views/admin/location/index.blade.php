@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>SMIRS Medina</h3>
                <p class="text-subtitle text-muted">
                    Sistem Manajemen Inventaris Rumah Sakit Medina
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Alokasi Inventaris</li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Lokasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Kelola Lokasi</h5>
                <div class="buttons">
                    <a href="{{ route('admin.locations.create') }}" class="btn icon btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Lokasi
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
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
                        @foreach ($locations as $location)
                            <tr>
                                <td>{{ $location->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <a href="{{ route('admin.locations.show', $location->id) }}" class="btn btn-info me-1 mb-1">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('admin.locations.edit', $location->id) }}" class="btn btn-warning me-1 mb-1">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger me-1 mb-1" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash-fill"></i> Delete
                                            </button>
                                        </form>
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
