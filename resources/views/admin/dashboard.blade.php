@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2">
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Inventaris</h6>
                                        <h6 class="font-extrabold mb-0">{{ $inventoryCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">User</h6>
                                        <h6 class="font-extrabold mb-0">{{ $usersCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green mb-2">
                                            <i class="fa-solid fa-sitemap"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Divisi</h6>
                                        <h6 class="font-extrabold mb-0">{{ $divisionsCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon red mb-2">
                                            <i class="fa-solid fa-shop"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pemasok</h6>
                                        <h6 class="font-extrabold mb-0">{{ $suppliersCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Inventaris Berdasarkan Kategori</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-inventaris-kategori">
                                    <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>User Berdasarkan Divisi</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-user-divisi">
                                    <canvas id="pieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            @php
                                $user = Auth::user(); // Get the authenticated user
                            @endphp
                            <div class="avatar avatar-xl">
                                @if($user->profile_photo != null)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Avatar" width="32" height="32" />
                            @else
                                <img src="{{ asset('default/image/user.jpg') }}" alt="Default Avatar" width="32" height="32" />
                            @endif                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{ $user->name }}</h5>
                                <h6 class="text-muted mb-0">{{ $user->role->name }} (Role)</h6>
                                <h7 class="text-muted mb-0">{{ $user->division->name }} (Divisi)</h7>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line Chart Data
    var lineChart = document.getElementById('lineChart').getContext('2d');
    new Chart(lineChart, {
        type: 'line',
        data: {
            labels: @json($categories), // Convert PHP array to JavaScript
            datasets: [{
                label: 'Jumlah Inventaris',
                data: @json($categoryCounts),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    // Pie Chart Data
    var pieChart = document.getElementById('pieChart').getContext('2d');
    new Chart(pieChart, {
        type: 'pie',
        data: {
            labels: ['Lokasi', 'Categories', 'Inventory', 'Users'],
            datasets: [{
                label: 'Data Breakdown',
                data: [{{ $locationsCount }}, {{ $divisionsCount }}, {{ $inventoryCount }}, {{ $usersCount }}],
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endsection
