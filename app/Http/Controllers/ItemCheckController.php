<?php

namespace App\Http\Controllers;

use App\Models\ItemCheck;
use App\Models\Location;
use Illuminate\Http\Request;

class ItemCheckController extends Controller
{
    /**
     * Menampilkan form untuk pengecekan barang di suatu lokasi.
     */
    public function create(Location $location)
    {
        $user = auth()->user();

        if ($user->role_id == 1) {
            // If role_id is 1, show all inventories at the location sorted by added_date
            $inventories = $location->inventories()->with('unit')->get();
        } elseif ($user->role_id == 2) {
            // If role_id is 2, filter inventories by user's division and sort by added_date
            $inventories = $location->inventories()
                ->with('unit')
                ->whereIn('category', function ($query) use ($user) {
                    $query->select('category')->from('divisions')->where('name', $user->division);
                })->get();
        } else {
            // Handle other roles if necessary, e.g., show no inventories
            $inventories = collect(); // Return an empty collection
        }

        return view('item_check_form', compact('location', 'inventories'));
    }

    /**
     * Menyimpan pengecekan barang harian.
     */
    public function store(Request $request, Location $location)
    {
        // Validasi input
        $validated = $request->validate([
            'inventories.*.status' => 'required|in:bagus,hilang,rusak,butuh_perbaikan',
            'inventories.*.description' => 'nullable|string',
        ]);

        $today = now()->toDateString();

        foreach ($validated['inventories'] as $inventoryId => $data) {
            // Cek apakah pengguna sudah melakukan pengecekan untuk barang ini hari ini
            $alreadyChecked = ItemCheck::where('user_id', auth()->id())
                ->where('location_id', $location->id)
                ->where('inventory_id', $inventoryId)
                ->whereDate('created_at', $today)
                ->exists();

            if ($alreadyChecked) {
                return redirect()->back()->with('error', "Anda sudah melakukan pengecekan untuk barang ID {$inventoryId} hari ini.");
            }

            // Simpan pengecekan barang
            ItemCheck::create([
                'user_id' => auth()->id(),
                'inventory_id' => $inventoryId,
                'location_id' => $location->id,
                'status' => $data['status'],
                'description' => $data['description'] ?? '',
            ]);
        }

        return redirect()->back()->with('success', 'Pengecekan barang berhasil disimpan.');
    }



    /**
     * Menampilkan riwayat pengecekan barang di suatu lokasi.
     */
    public function history(Location $location)
    {
        // Ambil riwayat pengecekan barang
        $itemChecks = ItemCheck::where('location_id', $location->id)->with(['user', 'inventory'])->get();
        return view('item_check_history', compact('itemChecks', 'location'));
    }
}
