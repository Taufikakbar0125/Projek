<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Role yang boleh dipilih berdasarkan role user yang login.
     * super_admin → semua role
     * admin       → hanya admin & staff (tidak bisa buat super_admin)
     */
    private function allowedRoles(): array
    {
        if (auth()->user()->isSuperAdmin()) {
            return ['super_admin', 'admin', 'staff'];
        }
        return ['admin', 'staff'];
    }

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $allowedRoles = $this->allowedRoles();
        return view('admin.users.create', compact('allowedRoles'));
    }

    public function store(Request $request)
    {
        $allowedRoles = $this->allowedRoles();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'role'     => ['required', 'in:' . implode(',', $allowedRoles)],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ], [
            'role.in' => 'Anda tidak memiliki izin untuk menetapkan role tersebut.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $allowedRoles = $this->allowedRoles();

        // Admin tidak bisa edit super_admin
        if (!auth()->user()->isSuperAdmin() && $user->isSuperAdmin()) {
            abort(403, 'Anda tidak bisa mengedit akun Super Admin.');
        }

        return view('admin.users.edit', compact('user', 'allowedRoles'));
    }

    public function update(Request $request, User $user)
    {
        $allowedRoles = $this->allowedRoles();

        // Admin tidak bisa edit super_admin
        if (!auth()->user()->isSuperAdmin() && $user->isSuperAdmin()) {
            abort(403, 'Anda tidak bisa mengedit akun Super Admin.');
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => ['required', 'in:' . implode(',', $allowedRoles)],
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ], [
            'role.in' => 'Anda tidak memiliki izin untuk menetapkan role tersebut.',
        ]);

        // Jangan izinkan siapapun menurunkan role dirinya sendiri
        if ($user->id === auth()->id() && $request->role !== auth()->user()->role) {
            return back()->withErrors(['role' => 'Anda tidak bisa mengubah role diri sendiri.']);
        }

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Tidak bisa hapus diri sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        // Admin tidak bisa hapus super_admin
        if (!auth()->user()->isSuperAdmin() && $user->isSuperAdmin()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak bisa menghapus akun Super Admin.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
