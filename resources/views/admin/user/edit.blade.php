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
                            <li class="breadcrumb-item active" aria-current="page">Kelola User</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
                            <h4 class="card-title">Edit User</h4>
                            <p class="text-subtitle text-muted">
                                Edit/ubah data user sesuai kebutuhan dan pastikan data yang dimasukkan sudah benar.
                            </p>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="name-column" class="form-label">Nama</label>
                                                <input type="text" id="name-column" class="form-control" placeholder="Nama Lengkap" name="name" value="{{ old('name', $user->name) }}" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="phone-column" class="form-label">Nomor Telepon</label>
                                                <input type="tel" id="phone-column" class="form-control" placeholder="Nomor Telepon/WhatsApp" name="phone" value="{{ old('phone', $user->phone) }}" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="email-id-column" class="form-label">Email</label>
                                                <input type="email" id="email-id-column" class="form-control" name="email" placeholder="Alamat Email" value="{{ old('email', $user->email) }}" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="password-column" class="form-label">Password (leave blank to keep current)</label>
                                                <input type="password" id="password-column" class="form-control" placeholder="Minimal 8 Karakter" name="password" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group mandatory">
                                                <label for="division-column" class="form-label">Divisi</label>
                                                <select name="division_id" class="form-select" required>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}" {{ $user->division_id == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group mandatory">
                                                <label for="role-column" class="form-label">Peran</label>
                                                <select name="role_id" class="form-select" required>
                                                    <option value="">Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <h6 class="card-title">Foto Profil (optional)</h6>
                                            <input type="file" class="image-crop-filepond" name="profile_photo" />
                                            <p class="card-text">Gunakan foto dengan rasio 1:1 agar tidak terpotong dan pastikan ukuran foto maksimal 500KB.</p>
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
        <!-- Basic multiple Column Form section end -->
    </div>
@endsection
