<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Menu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Edit Menu: {{ $product->nama_menu }}</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Menu -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Menu</label>
                <input type="text" name="nama_menu" value="{{ $product->nama_menu }}" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500" required>
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                <input type="number" name="harga" value="{{ $product->harga }}" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500">{{ $product->deskripsi }}</textarea>
            </div>

            <!-- Upload Foto -->
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Ganti Foto (Opsional)</label>
                
                @if($product->foto)
                    <div class="mb-2">
                        <p class="text-xs text-gray-500 mb-1">Foto Saat Ini:</p>
                        <img src="{{ asset('storage/' . $product->foto) }}" class="w-24 h-24 object-cover rounded-lg border">
                    </div>
                @endif

                <input type="file" name="foto" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-bold hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition shadow-lg">Update Menu</button>
            </div>
        </form>
    </div>

</body>
</html>