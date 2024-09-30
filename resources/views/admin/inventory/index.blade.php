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
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Kelola Inventaris
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Kelola Inventaris</h5>
            <div class="buttons">
                <a href="{{ route('admin.inventory.create') }}" class="btn icon btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah
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
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Kuantitas</th>
                        <th>Satuan</th>
                        <th>Tanggal Pengadaan</th>
                        <th>Pemasok</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->name }}</td>
                            <td>{{ $inventory->category }}</td>
                            <td>{{ $inventory->quantity }}</td>
                            <td>{{ $inventory->unit->name }}</td>
                            <td>{{ $inventory->added_date }}</td>
                            <td>{{ $inventory->supplier->name }}</td>
                            <td>
                                @if($inventory->image != null)
                                    <img src="{{ asset('storage/'.$inventory->image) }}" alt="Item Image" width="32" height="32"/>
                                @else
                                    <img src="{{ asset('default/image/inventary.jpeg') }}" alt="Default Image" width="32" height="32"/>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('admin.inventory.edit', $inventory->id) }}" class="btn btn-primary me-1 mb-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.inventory.destroy', $inventory->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger me-1 mb-1">
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
@endsection
