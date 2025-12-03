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
        <a href="/" target="_blank"
            class="hidden sm:flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-[#ff8c00] transition">
            <i class="fa-solid fa-earth-asia"></i> Lihat Website
        </a>

        <div class="h-8 w-[1px] bg-gray-300 hidden sm:block"></div>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-bold text-gray-800">Admin</p>
                <p class="text-xs text-gray-500">Administrator</p>
            </div>
            <div
                class="w-10 h-10 rounded-full bg-[#ff8c00] text-white flex items-center justify-center font-bold shadow-md ring-2 ring-orange-100">
                A
            </div>
        </div>
    </div>
</header>
