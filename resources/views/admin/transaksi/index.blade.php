<!DOCTYPE html>
<html lang="id">
<head>
    <title>Riwayat Transaksi - Admin Pak Ali</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #ff8c00; border-radius: 10px; }
        .sidebar-active { background-color: #fff7ed; color: #ff8c00; border-right: 4px solid #ff8c00; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        @include('admin.layouts.sidebar')

        <!-- MAIN CONTENT WRAPPER -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
            
            <!-- NAVBAR -->
            @include('admin.layouts.navbar')

            <!-- MAIN CONTENT -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                
                <!-- ALERT SUKSES -->
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check-circle"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">x</button>
                </div>
                @endif

                <!-- HEADER & FILTER -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Data Transaksi</h2>
                    
                    <div class="relative w-full md:w-1/3">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fa-solid fa-search"></i>
                        </span>
                        <input type="text" placeholder="Cari pesanan..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ff8c00] outline-none">
                    </div>
                </div>

                <!-- TABEL TRANSAKSI -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider font-semibold border-b border-gray-200">
                                    <th class="p-5">No Antrian</th>
                                    <th class="p-5">Nama Pemesan</th>
                                    <th class="p-5">Total</th>
                                    <th class="p-5">Waktu</th>
                                    <th class="p-5 text-center">Status</th>
                                    <th class="p-5 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse($transaksi as $trx)
                                <tr class="hover:bg-orange-50/30 transition">
                                    <td class="p-5">
                                        <span class="font-bold text-[#ff8c00] bg-orange-50 px-3 py-1 rounded-lg border border-orange-100">
                                            {{ $trx->no_antrian }}
                                        </span>
                                    </td>
                                    <td class="p-5 font-bold text-gray-800">
                                        {{ $trx->nama_pemesan }}
                                        @if($trx->catatan)
                                            <i class="fa-solid fa-note-sticky text-orange-400 ml-1" title="Ada catatan"></i>
                                        @endif
                                    </td>
                                    <td class="p-5 font-bold text-gray-800">
                                        Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="p-5 text-xs text-gray-500">
                                        {{ $trx->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="p-5 text-center">
                                        @if($trx->status_pembayaran == 'sudah_bayar')
                                            <span class="px-3 py-1 text-xs font-bold text-green-700 bg-green-100 rounded-full border border-green-200">
                                                LUNAS
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-bold text-red-700 bg-red-100 rounded-full border border-red-200 animate-pulse">
                                                BELUM BAYAR
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-5 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Tombol Detail -->
                                            <button onclick='openDetailModal(@json($trx))' class="w-8 h-8 rounded bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center border border-blue-100">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>

                                            <!-- Tombol Approve -->
                                            @if($trx->status_pembayaran == 'belum_bayar')
                                            <form action="{{ route('transaksi.confirm', $trx->id) }}" method="POST" onsubmit="return confirm('Konfirmasi LUNAS?')">
                                                @csrf
                                                <button type="submit" class="w-8 h-8 rounded bg-green-50 text-green-600 hover:bg-green-100 flex items-center justify-center border border-green-100" title="Terima Bayar">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-400">Belum ada transaksi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 bg-gray-50 border-t border-gray-100">
                        {{ $transaksi->links() }}
                    </div>
                </div>

            </main>

            <!-- FOOTER -->
            @include('admin.layouts.footer')

        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeDetailModal()"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl relative z-10 overflow-hidden">
                <div class="bg-[#ff8c00] px-6 py-4 flex justify-between items-center text-white">
                    <h3 class="font-bold text-lg">Detail Pesanan</h3>
                    <button onclick="closeDetailModal()"><i class="fa-solid fa-xmark text-xl"></i></button>
                </div>
                <div class="p-6 bg-gray-50">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-xs text-gray-500 uppercase">Nama</span>
                            <span class="font-bold text-gray-800" id="modalNama">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-gray-500 uppercase">Antrian</span>
                            <span class="font-bold text-[#ff8c00]" id="modalAntrian">-</span>
                        </div>
                    </div>

                    <h4 class="text-xs text-gray-500 uppercase font-bold mb-2 ml-1">Menu Dipesan</h4>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-4">
                        <ul id="modalList" class="divide-y divide-gray-100 text-sm">
                            <!-- Items via JS -->
                        </ul>
                        <div class="p-4 bg-orange-50 flex justify-between items-center border-t border-orange-100">
                            <span class="font-bold text-gray-700">Total</span>
                            <span class="font-extrabold text-[#ff8c00] text-lg" id="modalTotal">Rp 0</span>
                        </div>
                    </div>
                    
                    <div id="modalCatatanBox" class="bg-yellow-50 p-3 rounded-lg border border-yellow-200 text-sm text-yellow-800 italic hidden">
                        <i class="fa-solid fa-note-sticky mr-1"></i> <span id="modalCatatan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        // Sidebar Toggle Mobile
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

        // Modal Logic
        function openDetailModal(data) {
            document.getElementById('modalNama').innerText = data.nama_pemesan;
            document.getElementById('modalAntrian').innerText = data.no_antrian;
            document.getElementById('modalTotal').innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.total_harga);

            // Catatan
            const noteBox = document.getElementById('modalCatatanBox');
            if(data.catatan) {
                document.getElementById('modalCatatan').innerText = data.catatan;
                noteBox.classList.remove('hidden');
            } else {
                noteBox.classList.add('hidden');
            }

            // List Items
            const list = document.getElementById('modalList');
            list.innerHTML = '';
            
            if(data.items && data.items.length > 0) {
                data.items.forEach(item => {
                    const li = document.createElement('li');
                    li.className = 'p-3 flex justify-between items-center hover:bg-gray-50';
                    li.innerHTML = `
                        <div>
                            <div class="font-bold text-gray-800">${item.nama_produk_snapshot}</div>
                            <div class="text-xs text-gray-500">${item.jumlah} x Rp ${new Intl.NumberFormat('id-ID').format(item.harga_snapshot)}</div>
                        </div>
                        <div class="font-bold text-gray-600">Rp ${new Intl.NumberFormat('id-ID').format(item.subtotal)}</div>
                    `;
                    list.appendChild(li);
                });
            } else {
                list.innerHTML = '<li class="p-4 text-center text-gray-400 text-xs">Tidak ada detail item</li>';
            }

            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>
</body>
</html>