<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->paginate(10);
        return view('admin.menu.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            $input['foto'] = $request->file('foto')->store('menu-images', 'public');
        }

        Menu::create($input);

        return back()->with('success', 'Menu berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($menu->foto) {
                Storage::disk('public')->delete($menu->foto);
            }
            $input['foto'] = $request->file('foto')->store('menu-images', 'public');
        }

        $menu->update($input);

        return back()->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->foto) {
            Storage::disk('public')->delete($menu->foto);
        }
        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus!');
    }
}
