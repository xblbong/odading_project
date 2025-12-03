<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Menu Baru</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Tambah Menu Baru</h2>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Menu -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Menu</label>
                <input type="text" name="nama_menu" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500" placeholder="Contoh: Roti Goreng Coklat" required>
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                <input type="number" name="harga" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500" placeholder="Contoh: 3000" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500" placeholder="Penjelasan singkat menu..."></textarea>
            </div>

            <!-- Upload Foto -->
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Foto Menu</label>
                <input type="file" name="foto" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                <p class="text-xs text-gray-400 mt-1">*Format: JPG, PNG. Max: 2MB</p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-bold hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="px-6 py-3 bg-orange-600 text-white rounded-lg font-bold hover:bg-orange-700 transition shadow-lg">Simpan Menu</button>
            </div>
        </form>
    </div>

</body>
</html>