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
                        <li class="breadcrumb-item active" aria-current="page">Alokasi Inventaris</li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Lokasi</li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Lokasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Lokasi</h4>
                        <p class="text-subtitle text-muted">
                            Tambahkan lokasi baru sesuai kebutuhan dan pastikan data yang dimasukkan sudah benar.
                        </p>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.locations.store') }}" method="POST" class="form" data-parsley-validate>
                                @csrf
                                <div class="row">
                                    <!-- Input field for location name -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="location-column" class="form-label">Nama Lokasi</label>
                                            <input type="text" id="location-column" name="name" class="form-control" placeholder="Nama Lokasi" value="{{ old('name') }}" required />
                                        </div>
                                    </div>
                                    <!-- Action buttons -->
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
    <!-- Form section end -->
</div>
@endsection
