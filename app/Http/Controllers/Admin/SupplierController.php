<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama supplier harus diisi.',
            'name.string' => 'Nama supplier harus berupa string.',
            'name.max' => 'Nama supplier tidak boleh lebih dari 255 karakter.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'phone.string' => 'Nomor telepon harus berupa string.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'address.required' => 'Alamat harus diisi.',
            'address.string' => 'Alamat harus berupa string.',
            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
        ]);

        Supplier::create($request->all());

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil dibuat.');
    }

    public function show(Supplier $supplier)
    {
        return view('admin.supplier.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama supplier harus diisi.',
            'name.string' => 'Nama supplier harus berupa string.',
            'name.max' => 'Nama supplier tidak boleh lebih dari 255 karakter.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'phone.string' => 'Nomor telepon harus berupa string.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'address.required' => 'Alamat harus diisi.',
            'address.string' => 'Alamat harus berupa string.',
            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
        ]);

        $supplier->update($request->all());

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
