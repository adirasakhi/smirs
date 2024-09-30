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
                        <li class="breadcrumb-item active" aria-current="page">
                            Tambah Inventaris
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Inventaris</h4>
                        <p class="text-subtitle text-muted">
                            Tambahkan inventaris/barang baru sesuai kebutuhan dan pastikan data yang dimasukkan sudah benar.
                        </p>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.inventory.store') }}" method="POST" enctype="multipart/form-data" class="form" data-parsley-validate>
                                @csrf
                                <div class="row">
                                    <!-- Name Input -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="name-column" class="form-label">Nama</label>
                                            <input type="text" id="name-column" name="name" class="form-control" placeholder="Nama Barang" required>
                                        </div>
                                    </div>
                                    <!-- Added Date -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="date-column" class="form-label">Tanggal Pengadaan</label>
                                            <input type="date" id="date-column" name="added_date" class="form-control" placeholder="Pilih Tanggal" required>
                                        </div>
                                    </div>
                                    <!-- Quantity -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="quantity-column" class="form-label">Kuantitas</label>
                                            <input type="number" id="quantity-column" name="quantity" class="form-control" placeholder="Banyak Barang" required>
                                        </div>
                                    </div>
                                    <!-- Unit -->
                                    <div class="col-md-6 col-12">
                                        <fieldset class="form-group mandatory">
                                            <label for="unit-column" class="form-label">Satuan</label>
                                            <select name="unit_id" class="form-select" id="unit-column" required>
                                                @foreach($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <!-- Category -->
                                    <div class="col-md-6 col-12">
                                        <fieldset class="form-group mandatory">
                                            <label for="category-column" class="form-label">Kategori</label>
                                            <select name="category" class="form-select" id="category-column" required>
                                                <option value="perangkat">Perangkat</option>
                                                <option value="elektronik">Elektronik</option>
                                                <option value="kesehatan">Kesehatan</option>
                                                <option value="perlengkapan">Perlengkapan</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    <!-- Supplier -->
                                    <div class="col-md-6 col-12">
                                        <fieldset class="form-group mandatory">
                                            <label for="supplier-column" class="form-label">Pemasok</label>
                                            <select name="supplier_id" class="choices form-select" id="supplier-column" required>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <!-- Image -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <h6 class="card-title">Foto Barang</h6>
                                            <p class="card-text">
                                                Gunakan foto dengan rasio 3:4 agar tidak terpotong dan pastikan ukuran foto maksimal 500KB.
                                            </p>
                                            <input type="file" name="image" class="image-crop-filepond" image-crop-aspect-ratio="3:4" data-max-file-size="500KB">
                                        </div>
                                    </div>
                                    <!-- Submit Buttons -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Atur Ulang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic multiple Column Form section end -->
</div>
@endsection
