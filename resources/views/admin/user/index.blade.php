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
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Kelola User</h5>
                <div class="buttons">
                    <a href="{{ route('admin.users.create') }}" class="btn icon btn-primary"><i class="bi bi-person-plus-fill me-2"></i>Tambah</a>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Divisi</th>
                            <th>Peran</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @if ($user->role_id != 1) <!-- Exclude users with role_id = 1 -->
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->division->name }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        @if($user->profile_photo != null)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Avatar" width="32" height="32" />
                                        @else
                                            <img src="{{ asset('default/image/user.jpg') }}" alt="Default Avatar" width="32" height="32" />
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info me-1 mb-1"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning me-1 mb-1"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </section>
</div>
@endsection
