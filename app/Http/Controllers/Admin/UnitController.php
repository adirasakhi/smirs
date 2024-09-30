<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('admin.unit.index', compact('units'));
    }

    public function create()
    {
        return view('admin.unit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama unit harus diisi.',
            'name.string' => 'Nama unit harus berupa string.',
            'name.max' => 'Nama unit tidak boleh lebih dari 255 karakter.',
        ]);

        Unit::create($request->all());

        return redirect()->route('admin.units.index')->with('success', 'Unit berhasil dibuat.');
    }

    public function show(Unit $unit)
    {
        return view('admin.unit.show', compact('unit'));
    }

    public function edit(Unit $unit)
    {
        return view('admin.unit.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama unit harus diisi.',
            'name.string' => 'Nama unit harus berupa string.',
            'name.max' => 'Nama unit tidak boleh lebih dari 255 karakter.',
        ]);

        $unit->update($request->all());

        return redirect()->route('admin.units.index')->with('success', 'Unit berhasil diperbarui.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('admin.units.index')->with('success', 'Unit berhasil dihapus.');
    }
}
