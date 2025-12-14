<!DOCTYPE html>
<html lang="id">
<head>
    <title>Manajemen User - Admin Pak Ali</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        @include('admin.layouts.sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
            
            <!-- NAVBAR -->
            @include('admin.layouts.navbar')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                
                <!-- NOTIFIKASI -->
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded flex justify-between items-center">
                    <span><i class="fa-solid fa-check-circle mr-2"></i>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()">x</button>
                </div>
                @endif
                @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded flex justify-between items-center">
                    <span><i class="fa-solid fa-triangle-exclamation mr-2"></i>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()">x</button>
                </div>
                @endif

                <!-- HEADER & TOMBOL TAMBAH -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Admin</h2>
                    
                    <button onclick="document.getElementById('addUserModal').classList.remove('hidden')" 
                        class="bg-[#ff8c00] hover:bg-[#e06c00] text-white font-semibold py-2 px-4 rounded-lg shadow transition flex items-center gap-2">
                        <i class="fa-solid fa-user-plus"></i> Tambah Admin Baru
                    </button>
                </div>

                <!-- TABEL USER -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider font-semibold border-b border-gray-200">
                                    <th class="p-5">Nama Admin</th>
                                    <th class="p-5">Email Login</th>
                                    <th class="p-5">Terdaftar Pada</th>
                                    <th class="p-5 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @foreach($users as $user)
                                <tr class="hover:bg-orange-50/30 transition">
                                    <td class="p-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-orange-100 text-[#ff8c00] flex items-center justify-center font-bold">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                                @if($user->id == 1)
                                                    <span class="text-[10px] bg-[#ff8c00] text-white px-2 py-0.5 rounded-full">Super Admin</span>
                                                @else
                                                    <span class="text-[10px] bg-gray-200 text-gray-600 px-2 py-0.5 rounded-full">Admin Staff</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-5 text-gray-600">{{ $user->email }}</td>
                                    <td class="p-5 text-gray-500 text-xs">
                                        <i class="fa-regular fa-calendar mr-1"></i>
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="p-5 text-center">
                                        @if($user->id == 1 || $user->id == auth()->id())
                                            <!-- Tombol Hapus Disabled untuk Super Admin & Diri Sendiri -->
                                            <button disabled class="w-8 h-8 rounded bg-gray-100 text-gray-400 cursor-not-allowed border border-gray-200 flex items-center justify-center" title="Tidak bisa dihapus">
                                                <i class="fa-solid fa-lock"></i>
                                            </button>
                                        @else
                                            <!-- Tombol Hapus Aktif -->
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus admin {{ $user->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-8 h-8 rounded bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 border border-red-100 flex items-center justify-center transition" title="Hapus User">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 bg-gray-50 border-t border-gray-100">
                        {{ $users->links() }}
                    </div>
                </div>

            </main>
            
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- MODAL TAMBAH USER -->
    <div id="addUserModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="document.getElementById('addUserModal').classList.add('hidden')"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl relative z-10 overflow-hidden">
                <div class="bg-[#ff8c00] px-6 py-4 flex justify-between items-center text-white">
                    <h3 class="font-bold text-lg">Tambah Admin Baru</h3>
                    <button onclick="document.getElementById('addUserModal').classList.add('hidden')"><i class="fa-solid fa-xmark text-xl"></i></button>
                </div>
                
                <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full border rounded-lg px-3 py-2 focus:ring-[#ff8c00] outline-none border-gray-300" placeholder="Contoh: Budi Admin" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Login</label>
                        <input type="email" name="email" class="w-full border rounded-lg px-3 py-2 focus:ring-[#ff8c00] outline-none border-gray-300" placeholder="email@contoh.com" required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="newPass" class="w-full border rounded-lg px-3 py-2 focus:ring-[#ff8c00] outline-none border-gray-300" placeholder="Minimal 6 karakter" required minlength="6">
                            <i class="fa-solid fa-eye absolute right-3 top-3 text-gray-400 cursor-pointer hover:text-[#ff8c00]" onclick="toggleModalPass()"></i>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-[#ff8c00] hover:bg-[#e06c00] text-white font-bold py-2 rounded-lg shadow transition">
                            Simpan Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Toggle Password Modal & Sidebar -->
    <script>
        function toggleModalPass() {
            const x = document.getElementById("newPass");
            if (x.type === "password") { x.type = "text"; } else { x.type = "password"; }
        }
        
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
                setTimeout(() => sidebar.classList.add('hidden'), 300);
            }
        }
    </script>
</body>
</html>