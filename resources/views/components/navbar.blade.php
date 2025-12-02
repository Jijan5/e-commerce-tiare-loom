<nav class="fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Wrapper untuk glass effect dan rounded shape --}}
        <div class="relative flex items-center justify-between h-20 bg-white/30 backdrop-blur-lg shadow-lg rounded-full mt-4 border border-white/40">

            <!-- Kiri: Logo / Ikon -->
            <div class="flex-shrink-0 px-6">
                <a href="{{ url('/') }}">
                    {{-- Pastikan file icon.png ada di folder public/images/ --}}
                    <img class="h-20 w-auto" src="{{ asset('images/tiare-logo.png') }}" alt="Tiare Loom Logo">
                </a>
            </div>

            <!-- Tengah: Link Navigasi -->
            {{-- Menggunakan absolute positioning untuk memastikan menu selalu di tengah --}}
            <div class="absolute inset-y-0 left-1/2 transform -translate-x-1/2 hidden md:flex items-center space-x-4">
                <a href="#" class="text-gray-800 hover:text-black font-medium px-3 py-2 rounded-md text-sm transition-colors duration-300">Home</a>
                <a href="#" class="text-gray-800 hover:text-black font-medium px-3 py-2 rounded-md text-sm transition-colors duration-300">My Beads Bags</a>
                <a href="#" class="bg-black text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-gray-800 transition-colors duration-300">Order</a>
            </div>

            <!-- Kanan: Ikon Profil -->
            <div class="flex-shrink-0 px-6">
                <a href="#">
                    {{-- Placeholder untuk ikon profil dari heroicons.com --}}
                    <svg class="h-8 w-8 text-gray-700 hover:text-black transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </a>
            </div>

        </div>
    </div>
</nav>

<div class="h-28"></div>