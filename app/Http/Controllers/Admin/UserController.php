<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('id', '!=', 1)->get();
        $divisions = Division::all(); // Fetch divisions
        return view('admin.user.create', compact('roles', 'divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'division_id' => 'required|integer',
            'role_id' => 'required|integer',
            'phone' => 'required|string|max:15',
            'profile_photo' => 'nullable|image',
        ], [
            'name.required' => 'Nama pengguna harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'division_id.required' => 'Division ID harus diisi.',
            'role_id.required' => 'Role ID harus diisi.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'profile_photo.image' => 'File harus berupa gambar.',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dibuat.');
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::where('id', '!=', 1)->get();
        $divisions = Division::all();
        return view('admin.user.edit', compact('user', 'roles', 'divisions'));
    }

    public function update(Request $request, User $user)
    {
        // Validate input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'division_id' => 'required|integer',
            'role_id' => 'required|integer',
            'phone' => 'required|string|max:15',
            'profile_photo' => 'nullable|image|max:500',
        ], [
            'name.required' => 'Nama pengguna harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'division_id.required' => 'Division ID harus diisi.',
            'role_id.required' => 'Role ID harus diisi.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'profile_photo.image' => 'File harus berupa gambar.',
            'profile_photo.max' => 'Ukuran gambar maksimal 500KB.',
        ]);

        // Prepare the data, excluding the password if not filled
        $data = $request->except('password');

        // Update password only if it is provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8',  // Add confirmation check for password
            ]);
            $data['password'] = Hash::make($request->password);
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Optional: Delete the old profile photo if it exists
            if ($user->profile_photo) {
                \Storage::delete($user->profile_photo);  // Remove old photo from storage
            }

            // Store new profile photo
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        // Update the user with the new data
        $user->update($data);

        // Redirect with success message
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
