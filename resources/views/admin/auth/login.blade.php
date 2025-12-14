<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Jaya Pak Ali</title>
    
    <!-- Load Resources -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-white flex items-center justify-center min-h-screen p-4">

    <!-- Card Container -->
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 relative">
        
        <!-- Top Decoration Line -->
        <div class="h-2 bg-[#ff8c00] w-full"></div>

        <div class="p-8">
            <!-- Header / Logo -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-orange-50 text-[#ff8c00] mb-4 shadow-sm">
                    <i class="fa-solid fa-user-shield text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Admin Login</h2>
                <p class="text-sm text-gray-500 mt-1">Masuk untuk mengelola Catering Pak Ali</p>
            </div>

            <!-- Form -->
            <!-- Pastikan route-nya sesuai dengan route login di Laravel Anda -->
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email Input -->
                <div class="mb-5 relative">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" id="email" 
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#ff8c00] focus:border-transparent transition duration-200 placeholder-gray-400 @error('email') border-red-500 ring-red-100 @enderror"
                            placeholder="admin@example.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-6 relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" 
                            class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#ff8c00] focus:border-transparent transition duration-200 placeholder-gray-400"
                            placeholder="••••••••" required>
                        
                        <!-- Toggle Password Visibility -->
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-[#ff8c00] focus:outline-none">
                            <i id="eyeIcon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-[#ff8c00] focus:ring-[#ff8c00] border-gray-300 rounded cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-600 cursor-pointer">
                            Ingat Saya
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-[#ff8c00] hover:text-[#934a22] transition">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-[#ff8c00] hover:bg-[#934a22] text-white font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform active:scale-95 flex justify-center items-center gap-2">
                    Masuk Sekarang <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>

            </form>
        </div>
        {{-- footer --}}
        @include('admin.layouts.footer')
    </div>


    <!-- Script Show/Hide Password -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>