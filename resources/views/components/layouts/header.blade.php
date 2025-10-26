<header id="navbar"
    class="fixed top-0 left-0 w-full bg-transparent shadow-md transition-all duration-500 z-50 py-7">
    <nav class="container mx-auto flex items-center justify-between py-4">
        <!-- Logo -->
        <div class="flex items-center gap-x-3">
            <span
                class="h-10 w-10 flex items-center justify-center bg-white/30 rounded-full font-bold text-xl text-white shadow-md backdrop-blur-sm">
                R
            </span>
            <span class="font-bold text-white text-xl md:text-2xl tracking-wide">
                Roti Goreng & Cakwe Jaya Pak Ali!
            </span>
        </div>

        <!-- Hamburger Icon -->
        <button id="menu-btn"
            class="block md:hidden text-white focus:outline-none transition-transform duration-300">
            <i class="fa-solid fa-bars text-2xl"></i>
        </button>

        <!-- Menu -->
        <ul id="menu"
            class="hidden md:flex items-center gap-x-8 font-semibold text-white/90 text-lg transition-all duration-300">
            <li class="flex flex-col items-center group">
                <a href="#home" class="hover:text-white transition duration-300">Beranda</a>
                <span
                    class="bg-white/80 w-0 h-1 rounded-full transition-all duration-300 group-hover:w-[60%] group-hover:shadow-[0_0_10px_rgba(255,255,255,0.8)]"></span>
            </li>
            <li class="flex flex-col items-center group">
                <a href="#tentang-kami" class="hover:text-white transition duration-300">Tentang Kami</a>
                <span
                    class="bg-white/80 w-0 h-1 rounded-full transition-all duration-300 group-hover:w-[60%] group-hover:shadow-[0_0_10px_rgba(255,255,255,0.8)]"></span>
            </li>
            <li class="flex flex-col items-center group">
                <a href="#menu" class="hover:text-white transition duration-300">Menu</a>
                <span
                    class="bg-white/80 w-0 h-1 rounded-full transition-all duration-300 group-hover:w-[60%] group-hover:shadow-[0_0_10px_rgba(255,255,255,0.8)]"></span>
            </li>
            <li class="flex flex-col items-center group">
                <a href="#lokasi" class="hover:text-white transition duration-300">Lokasi</a>
                <span
                    class="bg-white/80 w-0 h-1 rounded-full transition-all duration-300 group-hover:w-[60%] group-hover:shadow-[0_0_10px_rgba(255,255,255,0.8)]"></span>
            </li>
            <li class="flex flex-col items-center group">
                <a href="#kontak" class="hover:text-white transition duration-300">Kontak</a>
                <span
                    class="bg-white/80 w-0 h-1 rounded-full transition-all duration-300 group-hover:w-[60%] group-hover:shadow-[0_0_10px_rgba(255,255,255,0.8)]"></span>
            </li>
        </ul>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        class="hidden flex-col items-center gap-y-6 bg-[#FF9D23]/90 text-white font-semibold text-lg py-6 md:hidden transition-all duration-500 shadow-lg">
        <a href="#home" class="hover:scale-105 transition">Beranda</a>
        <a href="#tentang-kami" class="hover:scale-105 transition">Tentang Kami</a>
        <a href="#menu" class="hover:scale-105 transition">Menu</a>
        <a href="#lokasi" class="hover:scale-105 transition">Lokasi</a>
        <a href="#kontak" class="hover:scale-105 transition">Kontak</a>
    </div>
</header>
