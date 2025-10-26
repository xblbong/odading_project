<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

    <div class="relative ">
        <img src="images/element-kanan.svg" class="absolute right-0 -top-20 w-72  object-cover rounded-lg" />
    </div>
    {{-- Menu Section --}}
    <section id="menu" class="mt-20 bg-[#C14600]">
        <div class="flex justify-start pt-28">
            <span class="w-1/5 h-14 rounded-r-4xl flex items-center bg-orange-200">
                <button
                    class="px-16 uppercase py-5 text-white bg-[#FF9D23] text-4xl font-bold rounded-br-full shadow-lg hover:bg-white hover:text-orange-400 transition"
                    style="transition: all 0.3s ease;" onmouseover="this.style.textShadow='none'"
                    onmouseout="this.style.textShadow='2px 2px 5px #682907'">
                    menu
                </button>
            </span>
        </div>

        {{-- card menu --}}
        <div class="container flex flex-wrap justify-center items-center gap-x-14 gap-y-24 ">
            {{-- card menu 1 --}}
            <div class="max-w-md bg-[#FCE9D1] rounded-2xl shadow-lg p-6 text-left space-y-4">
                <!-- Gambar -->
                <div
                    class="w-52 h-52 rounded-full flex flex-col items-center mx-auto justify-center overflow-hidden shadow-md -mt-20 border-4 border-[#FCE9D1]">
                    <img src="images/bakwan.svg" alt="Bakwan"
                        class="w-full bg-white p-7 rounded-4xl h-full object-cover">
                </div>

                <!-- Nama Makanan -->
                <h2 class="text-2xl font-extrabold text-[#A94E04] drop-shadow-[1px_1px_1px_#fff]">Bakwan</h2>

                <!-- Deskripsi -->
                <p class="text-[#7A3B0C] text-sm leading-relaxed">
                    Bakwan gurih dengan kombinasi sayuran segar dan adonan renyah, memberikan sensasi rasa yang lezat
                    dan
                    cocok untuk teman makan.
                </p>

                <!-- Harga -->
                <p class="font-semibold text-[#7A3B0C]">Harga: Rp. 2000,00</p>

                <!-- Tombol -->
                <button
                    class="bg-[#FF9D23] hover:bg-[#ffb648] text-white w-full font-bold py-2 px-6 rounded-lg shadow-md transition duration-300">
                    Pesan Sekarang
                </button>
            </div>
            {{-- card menu 2 --}}
            <div class="max-w-md bg-[#FCE9D1] rounded-2xl shadow-lg p-6 text-left space-y-4">
                <!-- Gambar -->
                <div
                    class="w-52 h-52 rounded-full flex flex-col items-center mx-auto justify-center overflow-hidden shadow-md -mt-20 border-4 border-[#FCE9D1]">
                    <img src="images/bakwan.svg" alt="Bakwan"
                        class="w-full bg-white p-7 rounded-4xl h-full object-cover">
                </div>

                <!-- Nama Makanan -->
                <h2 class="text-2xl font-extrabold text-[#A94E04] drop-shadow-[1px_1px_1px_#fff]">Bakwan</h2>

                <!-- Deskripsi -->
                <p class="text-[#7A3B0C] text-sm leading-relaxed">
                    Bakwan gurih dengan kombinasi sayuran segar dan adonan renyah, memberikan sensasi rasa yang lezat
                    dan
                    cocok untuk teman makan.
                </p>

                <!-- Harga -->
                <p class="font-semibold text-[#7A3B0C]">Harga: Rp. 2000,00</p>

                <!-- Tombol -->
                <button
                    class="bg-[#FF9D23] hover:bg-[#ffb648] text-white w-full font-bold py-2 px-6 rounded-lg shadow-md transition duration-300">
                    Pesan Sekarang
                </button>
            </div>
            {{-- card menu 3 --}}
            <div class="max-w-md bg-[#FCE9D1] rounded-2xl shadow-lg p-6 text-left space-y-4">
                <!-- Gambar -->
                <div
                    class="w-52 h-52 rounded-full flex flex-col items-center mx-auto justify-center overflow-hidden shadow-md -mt-20 border-4 border-[#FCE9D1]">
                    <img src="images/bakwan.svg" alt="Bakwan"
                        class="w-full bg-white p-7 rounded-4xl h-full object-cover">
                </div>

                <!-- Nama Makanan -->
                <h2 class="text-2xl font-extrabold text-[#A94E04] drop-shadow-[1px_1px_1px_#fff]">Bakwan</h2>

                <!-- Deskripsi -->
                <p class="text-[#7A3B0C] text-sm leading-relaxed">
                    Bakwan gurih dengan kombinasi sayuran segar dan adonan renyah, memberikan sensasi rasa yang lezat
                    dan
                    cocok untuk teman makan.
                </p>

                <!-- Harga -->
                <p class="font-semibold text-[#7A3B0C]">Harga: Rp. 2000,00</p>

                <!-- Tombol -->
                <button
                    class="bg-[#FF9D23] hover:bg-[#ffb648] text-white w-full font-bold py-2 px-6 rounded-lg shadow-md transition duration-300">
                    Pesan Sekarang
                </button>
            </div>
            {{-- card menu 4 --}}
            <div class="max-w-md bg-[#FCE9D1] rounded-2xl shadow-lg p-6 text-left space-y-4">
                <!-- Gambar -->
                <div
                    class="w-52 h-52 rounded-full flex flex-col items-center mx-auto justify-center overflow-hidden shadow-md -mt-20 border-4 border-[#FCE9D1]">
                    <img src="images/bakwan.svg" alt="Bakwan"
                        class="w-full bg-white p-7 rounded-4xl h-full object-cover">
                </div>

                <!-- Nama Makanan -->
                <h2 class="text-2xl font-extrabold text-[#A94E04] drop-shadow-[1px_1px_1px_#fff]">Bakwan</h2>

                <!-- Deskripsi -->
                <p class="text-[#7A3B0C] text-sm leading-relaxed">
                    Bakwan gurih dengan kombinasi sayuran segar dan adonan renyah, memberikan sensasi rasa yang lezat
                    dan
                    cocok untuk teman makan.
                </p>

                <!-- Harga -->
                <p class="font-semibold text-[#7A3B0C]">Harga: Rp. 2000,00</p>

                <!-- Tombol -->
                <button
                    class="bg-[#FF9D23] hover:bg-[#ffb648] text-white w-full font-bold py-2 px-6 rounded-lg shadow-md transition duration-300">
                    Pesan Sekarang
                </button>
            </div>
        </div>
        <div class="relative ">
            <img src="images/element-kiri.svg" class="absolute left-0 -top-20 w-72  object-cover rounded-lg" />
        </div>


        {{-- lokasi --}}
        <section class="relative mt-96">
            <!-- BAGIAN ATAS -->
            <img id="lokasi" src="images/roti-goreng-aja.svg" alt="Roti Goreng"
                class="absolute -top-56 left-1/2 -translate-x-1/2 w-96 h-96 opacity-90">
            <div class="relative h-40 bg-[#ff9c2378] -skew-y-10 flex items-center justify-center">
                <span class="relative text-white pb-10 font-extrabold text-5xl tracking-wider uppercase">Lokasi</span>
            </div>
            <div class="relative ">
                <img src="images/element-kanan.svg"
                    class="absolute z-11 right-0 -bottom-10 w-80  object-cover rounded-lg" />
            </div>
            <!-- BAGIAN BAWAH -->
            <div class="relative bg-[#f5eee7] -mt-10 -skew-y-10 pt-44 pb-96">
                <div class="skew-y-10 container mx-auto flex flex-col md:flex-row items-center gap-14 px-6">
                    <!-- MAP -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.396837376274!2d112.6091746!3d-7.957877799999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883762b863e49%3A0x97c724c305cc7397!2sCakwe%20dan%20Roti%20Goreng%20Bantal%20Jaya%20Pak%20Ali!5e0!3m2!1sen!2sid!4v1761470888064!5m2!1sen!2sid"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        class="rounded-xl w-full h-[500px] shadow-lg">
                    </iframe>

                    <!-- DESKRIPSI -->
                    <div class="space-y-5 text-gray-800">

                        <!-- Alamat -->
                        <div>
                            <span class="flex items-center gap-x-2">
                                <i class="fa-solid fa-location-dot text-orange-600 text-xl"></i>
                                <h3 class="text-lg font-semibold text-orange-700">Alamat</h3>
                            </span>
                            <p class="text-[#454545] ml-7">
                                Jl. Sigura - Gura, Sumbersari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145
                            </p>
                        </div>

                        <!-- Jam Operasional -->
                        <div>
                            <span class="flex items-center gap-x-2">
                                <i class="fa-solid fa-clock text-orange-600 text-xl"></i>
                                <h3 class="text-lg font-semibold text-orange-700">Jam Operasional</h3>
                            </span>
                            <p class="text-[#454545] ml-7">
                                06.00 - 10.00 WIB
                            </p>
                        </div>

                        <!-- GoFood -->
                        <div>
                            <span class="flex items-center gap-x-2">
                                <i class="fa-solid fa-utensils text-orange-600 text-xl"></i>
                                <h3 class="text-lg font-semibold text-orange-700">GoFood</h3>
                            </span>
                            <p class="text-[#454545] ml-7">
                                <a href="https://gofood.co.id/malang/restaurant/roti-goreng-cakwe-mas-ali-9685c91b-c371-4583-8278-9d7c8c50ab8b"
                                    class="text-orange-500 hover:underline">Roti Goreng Cakwe Mas Ali</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        {{-- contact us --}}
        <section id="kontak" class="relative w-full overflow-hidden -mt-48 md:-mt-44 lg:-mt-48">
            <!-- Judul di atas -->
            <div class="w-full bg-[#FF9D23] flex items-center justify-center py-10"
                style="box-shadow: 2px 2px 10px #682907;">
                <span class="text-white font-extrabold text-4xl uppercase">Kontak Kami</span>
            </div>

            <!-- Background dan konten -->
            <div class="relative w-full bg-cover bg-center overflow-hidden"
                style="background-image: url('images/banner-2.svg');">

                <!-- Overlay oranye transparan -->
                <div class="absolute inset-0 bg-[#c14700c0]"></div>

                <!-- Konten utama -->
                <div class="relative flex flex-col items-center justify-center text-center text-white py-24 md:py-44">
                    <!-- QR Code -->
                    <div class="bg-[#FF9D23] p-7 rounded-2xl shadow-lg">
                        <img src="images/nomor.svg" alt="QR Code" class="w-64 h-64 object-cover rounded-lg">
                    </div>

                    <!-- Tombol WhatsApp -->
                    <a href="https://wa.me/6285158329255?text=Halo%20saya%20ingin%20tanya%20mengenai%20pemesanan%20Cakwe%20dan%20Roti%20Goreng%20Bantal%20Jaya%20Pak%20Ali%2C%20apa%20bisa%3F"
                        class="mt-5 inline-flex items-center gap-x-2 bg-white text-orange-700 font-semibold px-20 py-3 rounded-full shadow-md hover:bg-orange-50 transition"
                        target="_blank">
                        <i class="fa-brands fa-whatsapp text-green-500 text-4xl"></i>
                        <p class="text-xl">Pesan Sekarang!</p>
                    </a>


                </div>
            </div>
        </section>
    </section>

    {{-- footer --}}
    @include('components.layouts.footer')

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
