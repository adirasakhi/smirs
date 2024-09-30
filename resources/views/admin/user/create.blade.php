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
                        <li class="breadcrumb-item active" aria-current="page">Kelola User</li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- User Creation Form -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah User</h4>
                        <p class="text-subtitle text-muted">
                            Tambahkan user baru sesuai kebutuhan dan pastikan data yang dimasukkan sudah benar.
                        </p>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="form" data-parsley-validate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="phone" class="form-label">Nomor Telepon</label>
                                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Nomor Telepon/WhatsApp" value="{{ old('phone') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Alamat Email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 8 Karakter" required minlength="8">
                                        </div>
                                    </div>

                                    <fieldset class="form-group mandatory">
                                        <label for="division_id" class="form-label">Divisi</label>
                                        <select name="division_id" id="division_id" class="form-select" required>
                                            <option value="">Pilih Divisi</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>


                                    <div class="col-md-6 col-12">
                                        <fieldset class="form-group mandatory">
                                            <label for="role_id" class="form-label">Peran</label>
                                            <select name="role_id" id="role_id" class="form-select" required>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <h6 class="card-title">Foto Profil</h6>
                                        <p class="card-text">Gunakan foto dengan rasio 1:1 agar tidak terpotong dan pastikan ukuran foto maksimal 500KB.</p>
                                        <input type="file" name="profile_photo" class="form-control" accept="image/*">
                                    </div>

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
</div>
@endsection
