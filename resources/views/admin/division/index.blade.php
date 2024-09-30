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
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola User</li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Divisi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Division List section start -->
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Kelola Divisi</h5>
                <div class="buttons">
                    <a href="{{ route('admin.divisions.create') }}" class="btn icon btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Divisi
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Divisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($divisions as $division)
                            <tr>
                                <td>{{ $division->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <a href="{{ route('admin.divisions.edit', $division->id) }}" class="btn btn-primary me-1 mb-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.divisions.destroy', $division->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger me-1 mb-1" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash-fill"></i>
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
    <!-- Division List section end -->
</div>
@endsection
