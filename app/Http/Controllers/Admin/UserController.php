<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Tampilkan semua user
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Admin baru berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        // Proteksi: ID 1 (Super Admin) tidak boleh dihapus
        if ($id == 1) {
            return back()->with('error', 'Akun Utama tidak bisa dihapus!');
        }

        // Proteksi: Tidak bisa menghapus diri sendiri yang sedang login
        if (Auth::id() == $id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri saat sedang login!');
        }

        User::findOrFail($id)->delete();

        return back()->with('success', 'User berhasil dihapus!');
    }
}
