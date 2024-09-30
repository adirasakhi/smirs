<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::all();
        return view('admin.division.index', compact('divisions'));
    }

    public function create()
    {
        return view('admin.division.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama divisi harus diisi.',
            'name.string' => 'Nama divisi harus berupa string.',
            'name.max' => 'Nama divisi tidak boleh lebih dari 255 karakter.',
        ]);

        Division::create($validated);

        return redirect()->route('admin.divisions.index')->with('success', 'Divisi berhasil dibuat');
    }

    public function edit(Division $division)
    {
        return view('admin.division.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama divisi harus diisi.',
            'name.string' => 'Nama divisi harus berupa string.',
            'name.max' => 'Nama divisi tidak boleh lebih dari 255 karakter.',
        ]);

        $division->update($validated);

        return redirect()->route('admin.divisions.index')->with('success', 'Divisi berhasil diperbarui');
    }

    public function destroy(Division $division)
    {
        try {
            $division->delete();
            return redirect()->route('admin.divisions.index')->with('success', 'Divisi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.divisions.index')->with('error', 'Gagal menghapus divisi. Silakan coba lagi.');
        }
    }
}
