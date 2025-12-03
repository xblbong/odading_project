<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Menampilkan daftar produk (Menu).
     */
    public function index()
    {
        // Ambil data terbaru, paginasi 10 item per halaman
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', // Max 2MB
        ]);

        // 2. Handle Upload Foto
        if ($request->hasFile('foto')) {
            // Simpan di folder: storage/app/public/products
            $path = $request->file('foto')->store('products', 'public');
            $validated['foto'] = $path;
        }

        // 3. Simpan ke Database
        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update data produk.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // 1. Validasi
        $rules = [
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ];

        $validated = $request->validate($rules);

        // 2. Handle Foto Baru (Jika ada)
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($product->foto && Storage::disk('public')->exists($product->foto)) {
                Storage::disk('public')->delete($product->foto);
            }

            // Simpan foto baru
            $path = $request->file('foto')->store('products', 'public');
            $validated['foto'] = $path;
        } else {
            // Jika tidak upload foto baru, hapus key 'foto' dari array validated agar tidak menimpa data lama jadi null
            unset($validated['foto']);
        }

        // 3. Update Database
        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Hapus produk.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // 1. Hapus File Foto dari Storage
        if ($product->foto && Storage::disk('public')->exists($product->foto)) {
            Storage::disk('public')->delete($product->foto);
        }

        // 2. Hapus Data dari Database
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Menu berhasil dihapus!');
    }
}