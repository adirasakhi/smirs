<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Location;
use App\Models\LocationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('admin.location.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama lokasi harus diisi.',
            'name.string' => 'Nama lokasi harus berupa string.',
            'name.max' => 'Nama lokasi tidak boleh lebih dari 255 karakter.',
        ]);

        Location::create($request->all());

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil dibuat.');
    }

    public function show(Location $location)
    {
        return view('admin.location.show', compact('location'));
    }

    public function edit(Location $location)
    {
        return view('admin.location.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama lokasi harus diisi.',
            'name.string' => 'Nama lokasi harus berupa string.',
            'name.max' => 'Nama lokasi tidak boleh lebih dari 255 karakter.',
        ]);

        $location->update($request->all());

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil dihapus.');
    }

    public function addinventories(Location $location)
    {
        $user = auth()->user();

        if ($user->role_id == 1) {
            // If role_id is 1, show all inventories sorted by added_date
            $inventories = Inventory::orderBy('added_date', 'desc')->get();
        } elseif ($user->role_id == 2) {
            // If role_id is 2, filter inventories by user's division and sort by added_date
            $inventories = Inventory::whereIn('category', function ($query) use ($user) {
                $query->select('category')->from('divisions')->where('name', $user->division);
            })->orderBy('added_date', 'desc')->get();
        } else {
            // Handle other roles if necessary, e.g., show no inventories
            $inventories = collect(); // Return an empty collection
        }

        return view('admin.allocation.add-inventories', compact('location', 'inventories'));
    }

    public function addaction(Request $request, Location $location)
    {
        // Validasi data inventori
        $request->validate([
            'inventories' => 'required|array', // Pastikan inventori dikirim sebagai array
            'inventories.*.inventory_id' => 'required|exists:inventories,id', // Validasi setiap ID inventori ada
            'inventories.*.quantity' => 'required|integer|min:1', // Validasi jumlah adalah integer positif
        ], [
            'inventories.required' => 'Data inventori harus disertakan.',
            'inventories.*.inventory_id.required' => 'ID inventori harus diisi.',
            'inventories.*.inventory_id.exists' => 'ID inventori tidak valid.',
            'inventories.*.quantity.required' => 'Jumlah harus diisi.',
            'inventories.*.quantity.integer' => 'Jumlah harus berupa angka.',
            'inventories.*.quantity.min' => 'Jumlah harus minimal 1.',
        ]);

        // Loop melalui inventori untuk memperbarui atau membuat catatan location_inventory
        foreach ($request->inventories as $inventoryData) {
            $inventory = Inventory::findOrFail($inventoryData['inventory_id']);

            // Cek apakah ada cukup jumlah di inventori
            if ($inventory->quantity >= $inventoryData['quantity']) {
                // Kurangi jumlah dari inventori
                $inventory->quantity -= $inventoryData['quantity'];
                $inventory->save(); // Simpan inventori yang diperbarui

                // Perbarui atau buat data location_inventory untuk lokasi tertentu
                LocationItem::updateOrCreate(
                    [
                        'location_id' => $location->id,
                        'inventory_id' => $inventory->id
                    ],
                    [
                        // Tambahkan jumlah alih-alih menggantinya
                        'quantity' => DB::raw('quantity + ' . $inventoryData['quantity'])
                    ]
                );
            } else {
                // Jika tidak ada cukup jumlah, redirect kembali dengan error
                return redirect()->back()->withErrors([
                    'message' => 'Jumlah tidak cukup tersedia untuk ' . $inventory->name
                ]);
            }
        }

        // Redirect kembali ke daftar lokasi dengan pesan sukses
        return redirect()->route('admin.alokasi.index')->with('success', 'Inventori untuk lokasi berhasil diperbarui.');
    }

    public function indexadd()
    {
        $locations = Location::all();
        return view('admin.allocation.index-add', compact('locations'));
    }
}
