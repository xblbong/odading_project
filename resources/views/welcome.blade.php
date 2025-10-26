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
    <section id="home" class="relative min-h-screen pt-32 flex items-center justify-between overflow-hidden">
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
                class="text-xl bg-[#ff8c00] text-white font-semibold px-7 py-3 rounded-full shadow-2xl hover:scale-105 hover:bg-white hover:text-orange-400 transition"
                style="box-shadow: 5px 2px 10px #934a22;">
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
                <img src="https://lh3.googleusercontent.com/gps-cs-s/AG0ilSxV-jM9bPDEb-99FS52kdqqzixoyaOvopRvN4CQe33IfLPCZY0cXSITjIu9EMRzcTs84kqC_aNzR_wTiAF4kCvAYaXYY0314a2E5DkvWZiLSC-_zTHbTdsbIRmL7BljZiBkdu-bWQ=s1360-w1360-h1020-rw"
                    class="w-44 h-44 rounded-full object-cover hover-roll" />
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
    <section id="tentang-kami">
        <div class="relative flex justify-end z-10 pt-28">
            <button
                class="px-16 uppercase py-5 text-white bg-[#FF9D23] text-4xl font-bold rounded-bl-full shadow-lg hover:bg-white hover:text-orange-400 transition"
                style="transition: all 0.3s ease;" onmouseover="this.style.textShadow='none'"
                onmouseout="this.style.textShadow='2px 2px 5px #682907'">
                tentang kami
            </button>
        </div>
        <div class="container flex justify-between items-center mt-20 gap-x-20">
            <div class="relative w-[150rem] h-[700px] flex items-center justify-center overflow-hidden">
                <!-- Slides -->
                <div class="relative w-full h-full">
                    <div
                        class="slide absolute inset-0 flex flex-col items-center justify-center transition-all duration-700 ease-in-out">
                        <img src="https://lh3.googleusercontent.com/gps-cs-s/AG0ilSxV-jM9bPDEb-99FS52kdqqzixoyaOvopRvN4CQe33IfLPCZY0cXSITjIu9EMRzcTs84kqC_aNzR_wTiAF4kCvAYaXYY0314a2E5DkvWZiLSC-_zTHbTdsbIRmL7BljZiBkdu-bWQ=s1360-w1360-h1020-rw"
                            class="w-[500px] h-[700px] object-cover rounded-xl shadow-xl transition-all duration-700" />
                        <p class="text-white font-semibold mt-2">John Wick: Chapter 4</p>
                    </div>

                    <div
                        class="slide absolute inset-0 flex flex-col items-center justify-center transition-all duration-700 ease-in-out">
                        <img src="https://lh3.googleusercontent.com/gps-cs-s/AG0ilSzFdiwHsTVRlg_aVVP3W7YOs8_6hoi7oR01Y3MDmwDoLZWgW_GrrywvHYP20j3U8_pNNaFf2J6bx3XJxXLf19hQhvcp6MBY-2OqvjQptTJH2x7r-GfUPfb4lA6oSnhIE2N1jaKq=s1360-w1360-h1020-rw"
                            class="w-[300px] h-[500px] object-cover rounded-xl shadow-xl transition-all duration-700" />
                        <p class="text-white font-semibold mt-2">Oppenheimer</p>
                    </div>

                    <div
                        class="slide absolute inset-0 flex flex-col items-center justify-center transition-all duration-700 ease-in-out">
                        <img src="https://lh3.googleusercontent.com/gps-cs-s/AG0ilSz1kP-pHFtTI5hVFxm3SP658_dynz2kviG2G-SyT1PlnSL3n5JLhOp4OKUjPUENs6QOs31cs7Wbid7N18GzF5EhW2vT9C-ziAwfxXwEK8ugZbOjeGYYZa-7pWAFcwl8AzEwW4GD=s1360-w1360-h1020-rw"
                            class="w-[300px] h-[500px] object-cover rounded-xl shadow-xl transition-all duration-700" />
                        <p class="text-white font-semibold mt-2">Avatar: The Way of Water</p>
                    </div>

                    <div
                        class="slide absolute inset-0 flex flex-col items-center justify-center transition-all duration-700 ease-in-out">
                        <img src="https://lh3.googleusercontent.com/gps-cs-s/AG0ilSyeYDHoxrV3h5kcfXZvtTYILS4wn7CZZ4bF9BCB5BLaTcce7FgQXz4bwmYkgVrBgf-cNf5ZZXwiTFQVfmhet3YYu7b0cTSnXk8AU3Ogv7UO-7FqbPgz7NSQ9_QmFj2Uvf8DalYEkw=s1360-w1360-h1020-rw"
                            class="w-[300px] h-[500px] object-cover rounded-xl shadow-xl transition-all duration-700" />
                        <p class="text-white font-semibold mt-2">Dune: Part Two</p>
                    </div>
                </div>

                <!-- Buttons -->
                <button id="prevBtn"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-gray-700 bg-opacity-60 hover:bg-opacity-90 text-white p-2 rounded-full z-50">
                    &#10094;
                </button>
                <button id="nextBtn"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-gray-700 bg-opacity-60 hover:bg-opacity-90 text-white p-2 rounded-full z-50">
                    &#10095;
                </button>
            </div>
            <div>
                <h3 class="font-bold text-4xl text-[#ff5e00] capitalize mb-3"
                    style="text-shadow: 2px 2px 10px #ffbf7fbb;">Roti Goreng & Cakwe Jaya Pak Ali!</h3>
                <p class="font-normal text-lg text-[#454545] capitalize">Sebuah usaha kuliner yang menyajikan berbagai
                    makanan ringan tradisional yang menggugah selera.
                    Kami berkomitmen untuk memberikan pengalaman rasa yang otentik dan berkualitas, melalui proses
                    pembuatan yang penuh dengan keahlian dan bahan-bahan terbaik.</p>
            </div>
        </div>
    </section>

    {{-- Menu Section --}}
    <section id="menu" class="mt-20">
        <div class="relative flex justify-start z-10 pt-28">
            <span class="w-64 bg-orange-200">
                <button
                    class="px-16 uppercase py-5 text-white bg-[#FF9D23] text-4xl font-bold rounded-br-full shadow-lg hover:bg-white hover:text-orange-400 transition"
                    style="transition: all 0.3s ease;" onmouseover="this.style.textShadow='none'"
                    onmouseout="this.style.textShadow='2px 2px 5px #682907'">
                    menu
                </button>
            </span>
        </div>
    </section>

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

        // Carousel Script
        const slides = document.querySelectorAll('.slide');
        let currentIndex = 0;
        const totalSlides = slides.length;

        function getRelativeIndex(index) {
            // hitung index relatif biar looping-nya lancar
            return (index + totalSlides) % totalSlides;
        }

        function updateCarousel() {
            slides.forEach((slide, index) => {
                const diff = getRelativeIndex(index - currentIndex);

                slide.style.transition = 'all 0.7s ease';

                // Reset semua
                slide.style.opacity = '0';
                slide.style.zIndex = '0';
                slide.style.transform = 'scale(0.7) translateX(0px)';
                slide.querySelector('img').style.filter = 'blur(10px) brightness(0.6)';

                if (diff === 0) {
                    // Tengah
                    slide.style.opacity = '1';
                    slide.style.zIndex = '10';
                    slide.style.transform = 'scale(1) translateX(0)';
                    slide.querySelector('img').style.filter = 'blur(0) brightness(1)';
                } else if (diff === 1) {
                    // Kanan
                    slide.style.opacity = '1';
                    slide.style.zIndex = '5';
                    slide.style.transform = 'scale(0.8) translateX(250px)';
                    slide.querySelector('img').style.filter = 'blur(3px) brightness(0.8)';
                } else if (diff === totalSlides - 1) {
                    // Kiri
                    slide.style.opacity = '1';
                    slide.style.zIndex = '5';
                    slide.style.transform = 'scale(0.8) translateX(-250px)';
                    slide.querySelector('img').style.filter = 'blur(3px) brightness(0.8)';
                }
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateCarousel();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }

        document.getElementById('nextBtn').addEventListener('click', nextSlide);
        document.getElementById('prevBtn').addEventListener('click', prevSlide);

        updateCarousel();
    </script>
</body>

</html>
