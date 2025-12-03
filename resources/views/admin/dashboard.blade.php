<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Dashboard - Jaya Pak Ali</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Load Resources -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Google Fonts (Optional: Inter/Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #ff8c00; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #e07b00; }
        
        .sidebar-active {
            background-color: #fff7ed; /* orange-50 */
            color: #ff8c00;
            border-right: 4px solid #ff8c00;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <div class="flex h-screen overflow-hidden">

        {{-- siderbar --}}
        @include('admin.layouts.sidebar')

        <!-- MAIN CONTENT WRAPPER -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
            
            <!-- HEADER / NAVBAR -->
            <header class="bg-white shadow-sm h-20 flex items-center justify-between px-6 z-30 relative">
                <div class="flex items-center gap-4">
                    <!-- Hamburger Button (Mobile) -->
                    <button onclick="toggleSidebar()" class="md:hidden text-gray-600 hover:text-[#ff8c00] focus:outline-none">
                        <i class="fa-solid fa-bars text-2xl"></i>
                    </button>
                    
                    <h2 class="text-xl font-bold text-gray-800 hidden sm:block">Dashboard Overview</h2>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('order.index') }}" target="_blank" class="hidden sm:flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-[#ff8c00] transition">
                        <i class="fa-solid fa-earth-asia"></i> Lihat Website
                    </a>
                    
                    <div class="h-8 w-[1px] bg-gray-300 hidden sm:block"></div>

                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-gray-800">Admin</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-[#ff8c00] text-white flex items-center justify-center font-bold shadow-md ring-2 ring-orange-100">
                            A
                        </div>
                    </div>
                </div>
            </header>

            <!-- SCROLLABLE CONTENT -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Card Income -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300 relative overflow-hidden group">
                        <div class="absolute right-0 top-0 h-full w-2 bg-[#ff8c00]"></div> <!-- Accent Line -->
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Pemasukan Bulan Ini</p>
                                <h3 class="text-2xl font-bold text-gray-800 group-hover:text-[#ff8c00] transition">
                                    Rp {{ number_format($incomeThisMonth, 0, ',', '.') }}
                                </h3>
                            </div>
                            <div class="p-3 rounded-xl bg-orange-50 text-[#ff8c00]">
                                <i class="fa-solid fa-wallet text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Card Orders -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300 relative overflow-hidden group">
                        <div class="absolute right-0 top-0 h-full w-2 bg-blue-500"></div> <!-- Accent Line -->
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Total Pesanan Bulan Ini</p>
                                <h3 class="text-2xl font-bold text-gray-800 group-hover:text-blue-600 transition">
                                    {{ $ordersCountMonth }} <span class="text-sm font-normal text-gray-500">Pesanan</span>
                                </h3>
                            </div>
                            <div class="p-3 rounded-xl bg-blue-50 text-blue-600">
                                <i class="fa-solid fa-bag-shopping text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Transaksi -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4 bg-white">
                        <div class="flex items-center gap-3">
                            <div class="w-1 h-6 bg-[#ff8c00] rounded-full"></div>
                            <h3 class="text-lg font-bold text-gray-800">Riwayat Pesanan Terbaru</h3>
                        </div>
                        <!-- Bisa ditambah filter/search di sini -->
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider font-semibold">
                                    <th class="p-5 border-b border-gray-100">ID Antrian</th>
                                    <th class="p-5 border-b border-gray-100">Customer Info</th>
                                    <th class="p-5 border-b border-gray-100 w-1/3">Detail Menu</th>
                                    <th class="p-5 border-b border-gray-100">Total Tagihan</th>
                                    <th class="p-5 border-b border-gray-100 text-center">Status</th>
                                    <th class="p-5 border-b border-gray-100 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse($orders as $order)
                                <tr class="hover:bg-orange-50/30 transition duration-200">
                                    <td class="p-5">
                                        <span class="font-bold text-[#ff8c00] bg-orange-50 px-3 py-1 rounded-full border border-orange-100">
                                            #{{ $order->id }}
                                        </span>
                                    </td>
                                    <td class="p-5">
                                        <div class="font-bold text-gray-800 text-base">{{ $order->nama_pemesan }}</div>
                                        <div class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                            <i class="fa-regular fa-clock"></i> {{ $order->created_at->format('d M Y, H:i') }}
                                        </div>
                                    </td>
                                    <td class="p-5">
                                        <div class="bg-gray-50 rounded-lg p-3 border border-gray-100">
                                            <ul class="space-y-1 text-gray-600">
                                                @foreach($order->items as $item)
                                                    <li class="flex justify-between text-xs sm:text-sm">
                                                        <span>{{ $item->nama_produk_snapshot }}</span>
                                                        <span class="font-semibold">x{{ $item->jumlah }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @if($order->catatan)
                                                <div class="mt-2 pt-2 border-t border-gray-200 text-xs text-orange-600 italic flex items-start gap-1">
                                                    <i class="fa-solid fa-note-sticky mt-0.5"></i>
                                                    "{{ $order->catatan }}"
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-5">
                                        <div class="font-bold text-gray-800 text-lg">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="p-5 text-center">
                                        @if($order->status_pembayaran == 'sudah_bayar')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-bold text-green-700 bg-green-100 rounded-full border border-green-200">
                                                <i class="fa-solid fa-check-circle"></i> LUNAS
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-bold text-red-700 bg-red-100 rounded-full border border-red-200 animate-pulse">
                                                <i class="fa-solid fa-clock"></i> BELUM BAYAR
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-5 text-center">
                                        @if($order->status_pembayaran == 'belum_bayar')
                                            <form action="{{ route('admin.approve', $order->id) }}" method="POST" onsubmit="return confirm('Konfirmasi pembayaran untuk pesanan #{{ $order->id }}?')">
                                                @csrf
                                                <button type="submit" class="w-full sm:w-auto bg-[#ff8c00] hover:bg-orange-600 text-white text-xs font-medium px-4 py-2 rounded-lg shadow-md shadow-orange-200 hover:shadow-lg transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                                    <i class="fa-solid fa-check"></i> Terima Bayar
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="w-full sm:w-auto bg-gray-100 text-gray-400 text-xs font-medium px-4 py-2 rounded-lg cursor-not-allowed flex items-center justify-center gap-2 border border-gray-200">
                                                <i class="fa-solid fa-lock"></i> Selesai
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-400">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-box-open text-4xl mb-3 text-gray-300"></i>
                                            <p>Belum ada pesanan masuk.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($orders->hasPages())
                    <div class="p-4 bg-white border-t border-gray-100">
                        {{ $orders->links() }}
                    </div>
                    @endif
                </div>

                
            </main>
            {{-- footer --}}
             @include('admin.layouts.footer')
        </div>
    </div>

    <!-- Script Inline untuk Mobile Sidebar Toggle -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar.classList.contains('hidden')) {
                // Show Sidebar
                sidebar.classList.remove('hidden');
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                // Hide Sidebar
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                setTimeout(() => {
                    sidebar.classList.add('hidden');
                }, 300); // Wait for transition
            }
        }
    </script>
</body>
</html>