@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Monitoring Inventaris Ruangan {{ $location->name }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cek Barang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="actions">
                    {{-- <button class="btn btn-primary" onclick="exportData()">Export</button> --}}
                    {{-- <button class="btn btn-secondary">Histori</button> --}}
                    <a href="{{ route('locations.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('item_checks.store', $location->id) }}" method="POST">
                    @csrf
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nama Inventaris</th>
                                <th>Kategori</th>
                                <th>Tanggal Ditambahkan</th>
                                <th>Supplier</th>
                                <th>Kuantitas</th>
                                <th>Lakukan Pengecekan Sebagai</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventories as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $item->supplier->name }}</td>
                                    <td>{{ $item->pivot->quantity }} {{ $item->unit->name }}</td>
                                    <td>
                                        <select name="inventories[{{ $item->id }}][status]" class="form-control">
                                            <option value="baik">Baik</option>
                                            <option value="hilang">hilang</option>
                                            <option value="rusak">Rusak</option>
                                            <option value="perlu_perbaikan">Perlu Perbaikan</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea name="inventories[{{ $item->id }}][description]" id="description" cols="30" rows="10" placeholder="Deskripsi..."></textarea>
                                    </td>
                                    <td>
                                        <img src="{{ $item->image_url }}" style="height: 50px;">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
