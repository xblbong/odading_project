<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('components.layouts.header')

    <!-- SECTION HERO -->
    <section class="relative min-h-screen pt-32 flex items-center justify-between overflow-hidden">
        <!-- Background image + overlay -->
        <img src="images/banner.svg" class="absolute inset-0 bg-cover w-full" />
        <div class="absolute inset-0 bg-[#B64F0B]/70"></div>

        <!-- Konten kiri -->
        <div class="relative -top-42 left-24 z-10 w-1/2 px-16 text-white">
            <h1 class="mb-10 text-4xl md:text-6xl font-extrabold leading-tight"
                style="text-shadow: 2px 2px 1px #682907;">
                Selamat Datang di, <br>
                <span class="text-[#ffae00]">Roti Goreng & Cakwe</span> <br>
                Jaya Pak Ali!
            </h1>

            <button
                class="text-xl bg-[#ff8c00] text-white font-semibold px-7 py-3 rounded-full shadow-2xl hover:scale-105 hover:bg-white hover:text-orange-400 transition" style="box-shadow: 5px 2px 10px #934a22;">
                Pesan Sekarang →
            </button>

        </div>
        <!-- Deretan gambar menu -->
        <div
            class="absolute left-0 bottom-52 z-10 h-28 bg-[#ff8c00] px-8  rounded-r-xl flex items-center justify-start gap-x-7 shadow-lg overflow-visible">
            <div class="relative">
                <img src="images/bala-bala.svg" class="w-56 h-5w-56 rounded-full object-cover roll" />
            </div>
            <div class="relative">
                <img src="images/roti-goreng-aja.svg" class="w-44 h-44 rounded-full object-cover hover-roll" />
            </div>
            <div class="relative">
                <img src="images/molen.svg" class="w-44 h-44 rounded-full object-cover hover-roll" />
            </div>
            <div class="relative">
                <img src="images/cakue.svg" class="w-44 h-44 rounded-full object-cover hover-roll" />
            </div>
        </div>

        <!-- Konten kanan -->
        <div class="relative z-10 w-1/2 flex justify-end left-10 ">
            <img src="images/roti-goreng.svg" class="w-[50rem] h-[50rem] object-cover rounded-lg" />
        </div>

        <!-- Gradasi bawah -->
        <div class="absolute bottom-0 left-0 w-full h-44 fade-bottom"></div>
    </section>

    <div class="relative bottom-0 left-0 mb-32">
        <div class="absolute top-0 left-0 w-full h-32 fade-top z-0"></div>
    </div>

    {{-- about section --}}
    <div class="relative z-10">
        <h1>welcome</h1>
    </div>


    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif

    <script>
        window.addEventListener("scroll", function() {
            const navbar = document.getElementById("navbar");
            if (window.scrollY > 10) {
                navbar.classList.remove("bg-transparent");
                navbar.classList.add("bg-[#ff8c00]", "shadow-md", "backdrop-blur-md");
            } else {
                navbar.classList.add("bg-transparent");
                navbar.classList.remove("bg-[#ff8c00]", "shadow-md", "backdrop-blur-md");
            }
        });
    </script>
</body>

</html>
