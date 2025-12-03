<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Menu - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
    
    <div class="container mx-auto p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Menu</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('products.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-bold shadow-lg">
                    <i class="fa-solid fa-plus"></i> Tambah Menu
                </a>
            </div>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                        <th class="p-4 border-b">Foto</th>
                        <th class="p-4 border-b">Nama Menu</th>
                        <th class="p-4 border-b">Harga</th>
                        <th class="p-4 border-b">Deskripsi</th>
                        <th class="p-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4">
                            @if($product->foto)
                                <img src="{{ asset('storage/' . $product->foto) }}" class="w-16 h-16 object-cover rounded-lg shadow-sm">
                            @else
                                <span class="text-gray-400 text-xs">No Image</span>
                            @endif
                        </td>
                        <td class="p-4 font-bold text-gray-800">{{ $product->nama_menu }}</td>
                        <td class="p-4 text-orange-600 font-semibold">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td class="p-4 text-sm text-gray-500 max-w-xs truncate">{{ $product->deskripsi ?? '-' }}</td>
                        <td class="p-4 flex gap-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700 border border-blue-200 p-2 rounded-md hover:bg-blue-50">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 border border-red-200 p-2 rounded-md hover:bg-red-50">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">Belum ada menu yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="p-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>

</body>
</html>