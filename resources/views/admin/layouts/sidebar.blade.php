<!DOCTYPE html>
<html lang="id">

<head>
    <title>Admin Dashboard - Jaya Pak Ali</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     {{-- Load Resources --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

     {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #ff8c00;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #e07b00;
        }

        .sidebar-active {
            background-color: #fff7ed;
            /* orange-50 */
            color: #ff8c00;
            border-right: 4px solid #ff8c00;
        }
    </style>
</head>

<body>
    {{--  SIDEBAR --}}
     {{-- Hidden on mobile, fixed on desktop --}}
    <aside id="sidebar"
        class="bg-white w-64 shadow-xl flex-col fixed inset-y-0 left-0 z-50 transform -translate-x-full transition-transform duration-300 md:relative md:translate-x-0 md:flex hidden">
         {{-- Logo Area --}}
        <div class="h-20 flex items-center justify-center border-b border-gray-100 px-6">
            <div class="flex items-center gap-3">
                <div class="bg-[#ff8c00] text-white p-2 rounded-lg">
                    <i class="fa-solid fa-utensils text-xl"></i>
                </div>
                <h1 class="text-xl font-bold tracking-wide text-gray-800">Pak Ali <span
                        class="text-[#ff8c00]">Jaya</span></h1>
            </div>
        </div>

         {{-- Menu Items --}}
        <nav class="flex-1 py-6 space-y-1 overflow-y-auto">
             {{-- Menu Pemesanan (Aktif) --}}
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()-> routeIs(patterns: 'admin.dashboard') ? 'sidebar-active' : 'text-gray-500' }} flex items-center gap-3 px-6 py-3 font-medium transition-colors hover:bg-orange-50 hover:text-[#ff8c00]">
                <i class="fa-solid fa-clipboard-list w-6 text-center"></i>
                Dashboard
            </a>

             {{-- Menu Daftar Menu (Placeholder Link) --}}
            <a href="{{ route('menu.index') }}"
                class="{{ request()->routeIs('menu.index') ? 'sidebar-active' : 'text-gray-500'}} flex items-center gap-3 px-6 py-3 font-medium transition-colors hover:bg-orange-50 hover:text-[#ff8c00]">
                <i class="fa-solid fa-book-open w-6 text-center"></i>
                Daftar Menu
            </a>

             {{-- Menu Transaksi (Placeholder Link) --}}
            <a href="{{ route(name: 'transaksi.index') }}"
                class="{{ request() -> routeIs('transaksi.index') ? 'sidebar-active' : 'text-gray-500' }} flex items-center gap-3 px-6 py-3 font-medium transition-colors hover:bg-orange-50 hover:text-[#ff8c00]">
                <i class="fa-solid fa-file-invoice-dollar w-6 text-center"></i>
                Transaksi
            </a>
        </nav>

         {{-- Sidebar Footer --}}
        <div class="p-4 border-t border-gray-100">
            <a href="#"
                class="flex items-center gap-3 px-4 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </div>
    </aside>

     {{-- Overlay Mobile --}}
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>

</body>
</html>
