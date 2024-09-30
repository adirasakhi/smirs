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
                        <li class="breadcrumb-item active" aria-current="page">Alokasi Inventaris</li>
                        <li class="breadcrumb-item active" aria-current="page">Alokasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Alokasi Inventaris</h4>
                        <p class="text-subtitle text-muted">Alokasikan Inventaris/barang sesuai dengan tempat yang sesuai.</p>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.location.action.inventories', $location->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="location_name">Location Name</label>
                                    <input type="text" id="location_name" name="location_name" class="form-control" value="{{ $location->name }}" disabled>
                                </div>

                                <table class="table table-striped" id="inventoryTable">
                                    <thead>
                                        <tr>
                                            <th>Pilih Inventaris</th>
                                            <th>Kuantitas</th>
                                            <th>Aksi</th> <!-- Tambahkan kolom untuk aksi -->
                                        </tr>
                                    </thead>
                                    <tbody id="inventoryRows">
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <select name="inventories[0][inventory_id]" class="form-control" required>
                                                        <option value="" disabled selected>Silakan pilih inventaris/barang yang akan dialokasikan</option>
                                                        @foreach($inventories as $inventory)
                                                            <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" name="inventories[0][quantity]" class="form-control" min="0" required placeholder="Banyak Barang">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger removeInventory" style="display: none;">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="col-12 d-flex justify-content-end mb-3">
                                    <button type="button" id="addInventoryButton" class="btn btn-secondary me-1 mb-1">
                                        <i class="bi bi-file-plus-fill"></i> Tambah Inventaris
                                    </button>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Atur Ulang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@section('scripts')
<script>
    let inventoryCount = 1; // Initialize the inventory count

    document.getElementById('addInventoryButton').addEventListener('click', function() {
        // Create a new row
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <div class="form-group">
                    <select name="inventories[${inventoryCount}][inventory_id]" class="form-control" required>
                        <option value="" disabled selected>Silakan pilih inventaris/barang yang akan dialokasikan</option>
                        @foreach($inventories as $inventory)
                            <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td>
                <input type="number" name="inventories[${inventoryCount}][quantity]" class="form-control" min="0" required placeholder="Banyak Barang">
            </td>
            <td>
                <button type="button" class="btn btn-danger removeInventory" style="display: none;">
                    <i class="bi bi-x-circle"></i>
                </button>
            </td>
        `;

        // Append the new row to the inventory table
        document.getElementById('inventoryRows').appendChild(newRow);

        // Show the remove button on hover
        newRow.addEventListener('mouseenter', function() {
            newRow.querySelector('.removeInventory').style.display = 'inline-block';
        });
        newRow.addEventListener('mouseleave', function() {
            newRow.querySelector('.removeInventory').style.display = 'none';
        });

        // Add event listener to the remove button
        newRow.querySelector('.removeInventory').addEventListener('click', function() {
            newRow.remove(); // Remove the row when the button is clicked
        });

        // Increment the inventory count
        inventoryCount++;
    });

    // Show remove button on hover for existing rows
    const existingRows = document.querySelectorAll('#inventoryRows tr');
    existingRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            row.querySelector('.removeInventory').style.display = 'inline-block';
        });
        row.addEventListener('mouseleave', function() {
            row.querySelector('.removeInventory').style.display = 'none';
        });

        row.querySelector('.removeInventory').addEventListener('click', function() {
            row.remove(); // Remove the row when the button is clicked
        });
    });
</script>
@endsection
@endsection
