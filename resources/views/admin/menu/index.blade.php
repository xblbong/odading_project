<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Menu - Admin Pak Ali</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <div class="flex h-screen overflow-hidden">
       {{-- sidebar --}}
       @include('admin.layouts.sidebar')

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
            
           @include('admin.layouts.navbar')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-10">
                
                <!-- ALERT SUKSES -->
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center" role="alert">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check-circle"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">x</button>
                </div>
                @endif

                <!-- TOP ACTION -->
                <div class="flex flex-col md:flex-row justify-between items-left mb-6 gap-4">
                    <div class="relative w-full md:w-1/3">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fa-solid fa-search"></i></span>
                        <input type="text" placeholder="Cari menu..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ff8c00] outline-none shadow-sm">
                    </div>
                    <button onclick="openModal('addModal')" class="bg-[#ff8c00] hover:bg-[#934a22] text-white font-semibold py-2 px-4 rounded-lg shadow transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Tambah Menu
                    </button>
                </div>

                <!-- TABLE -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider font-semibold border-b border-gray-200">
                                    <th class="p-5">Gambar</th>
                                    <th class="p-5">Nama Menu</th>
                                    <th class="p-5">Kategori</th>
                                    <th class="p-5">Harga</th>
                                    <th class="p-5 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse($menus as $menu)
                                <tr class="hover:bg-orange-50/30 transition">
                                    <td class="p-4">
                                        @if($menu->foto)
                                            <img src="{{ asset('storage/' . $menu->foto) }}" class="w-16 h-16 rounded-lg object-cover border">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs">No IMG</div>
                                        @endif
                                    </td>
                                    <td class="p-4 font-bold text-gray-800">{{ $menu->nama_menu }}
                                        <div class="text-xs text-gray-400 font-normal mt-1">{{ Str::limit($menu->deskripsi, 30) }}</div>
                                    </td>
                                    <td class="p-4"><span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-bold">{{ $menu->kategori }}</span></td>
                                    <td class="p-4 font-bold text-[#ff8c00]">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                    <td class="p-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Tombol Edit (Pemicu JS) -->
                                            <button onclick="openEditModal({{ $menu }})" class="w-8 h-8 rounded bg-yellow-100 text-yellow-600 hover:bg-yellow-200 flex items-center justify-center transition">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            
                                            <!-- Form Delete -->
                                            <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Hapus menu ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-8 h-8 rounded bg-red-100 text-red-600 hover:bg-red-200 flex items-center justify-center transition">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center p-8 text-gray-400">Belum ada data menu.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4">{{ $menus->links() }}</div>
                </div>
            </main>
        </div>
    </div>

    <!-- MODAL TAMBAH (ADD) -->
    <div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black/50 transition-opacity" onclick="closeModal('addModal')"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl w-full max-w-lg shadow-xl relative z-10 overflow-hidden">
                <div class="bg-[#ff8c00] px-6 py-4 flex justify-between items-center text-white">
                    <h3 class="font-bold text-lg">Tambah Menu Baru</h3>
                    <button onclick="closeModal('addModal')"><i class="fa-solid fa-xmark text-xl"></i></button>
                </div>
                <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
                        <input type="text" name="nama_menu" class="w-full border rounded-lg px-3 py-2 focus:ring-[#ff8c00] outline-none" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="kategori" class="w-full border rounded-lg px-3 py-2 focus:ring-[#ff8c00] outline-none">
                                <option>Makanan Berat</option>
                                <option>Minuman</option>
                                <option>Snack</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <input type="number" name="harga" class="w-full border rounded-lg px-3 py-2 focus:ring-[#ff8c00] outline-none" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="2" class="w-full border rounded-lg px-3 py-2 focus:ring-[#ff8c00] outline-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                        <input type="file" name="foto" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#ff8c00] hover:file:bg-orange-100">
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-[#ff8c00] hover:bg-[#934a22] text-white px-6 py-2 rounded-lg font-bold shadow transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT (EDIT) -->
    <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black/50 transition-opacity" onclick="closeModal('editModal')"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl w-full max-w-lg shadow-xl relative z-10 overflow-hidden">
                <div class="bg-gray-800 px-6 py-4 flex justify-between items-center text-white">
                    <h3 class="font-bold text-lg">Edit Menu</h3>
                    <button onclick="closeModal('editModal')"><i class="fa-solid fa-xmark text-xl"></i></button>
                </div>
                <!-- Action Form akan diisi via JS -->
                <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf 
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
                        <input type="text" id="edit_nama" name="nama_menu" class="w-full border rounded-lg px-3 py-2 focus:ring-gray-800 outline-none" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select id="edit_kategori" name="kategori" class="w-full border rounded-lg px-3 py-2 focus:ring-gray-800 outline-none">
                                <option>Makanan Berat</option>
                                <option>Minuman</option>
                                <option>Snack</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <input type="number" id="edit_harga" name="harga" class="w-full border rounded-lg px-3 py-2 focus:ring-gray-800 outline-none" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="edit_deskripsi" name="deskripsi" rows="2" class="w-full border rounded-lg px-3 py-2 focus:ring-gray-800 outline-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto (Opsional)</label>
                        <input type="file" name="foto" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-2 rounded-lg font-bold shadow transition">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('-translate-x-full');
        }

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        // Fungsi untuk mengisi data ke Modal Edit secara dinamis
        function openEditModal(data) {
            // 1. Buka Modal
            openModal('editModal');
            
            // 2. Set Action URL Form (Route Update)
            // Ganti 'admin/menu' sesuai prefix route kamu
            document.getElementById('editForm').action = '/admin/menu/' + data.id;

            // 3. Isi Inputan dengan Data Lama
            document.getElementById('edit_nama').value = data.nama_menu;
            document.getElementById('edit_harga').value = data.harga;
            document.getElementById('edit_deskripsi').value = data.deskripsi;
            document.getElementById('edit_kategori').value = data.kategori;
        }
    </script>
</body>
</html>