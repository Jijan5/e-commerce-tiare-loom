<style>
    .nav-link-underline-wrapper .nav-link-underline {
        position: relative;
        display: inline-block;
    }
    .nav-link-underline-wrapper .nav-link-underline::after {
        content: '';
        position: absolute;
        bottom: -4px; /* Atur jarak garis dari teks */
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background-color: #c5b358; /* Warna emas */
        transition: width 0.3s ease-in-out;
    }
    .nav-link-underline-wrapper:hover .nav-link-underline::after {
        width: 100%;
    }
</style>
<nav class="fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Wrapper untuk glass effect dan rounded shape --}}
        <div class="relative flex items-center justify-between h-20 bg-white/50 backdrop-blur-lg shadow-lg rounded-full mt-4 border border-white/50">

            <!-- Kiri: Logo / Ikon -->
            <div class="flex-shrink-0 px-6">
                <a href="{{ url('/') }}">
                    {{-- Pastikan file icon.png ada di folder public/images/ --}}
                    <img class="h-20 w-auto" src="{{ asset('images/tiare-logo.png') }}" alt="Tiare Loom Logo">
                </a>
            </div>

            <!-- Tengah: Link Navigasi -->
            {{-- Menggunakan absolute positioning untuk memastikan menu selalu di tengah --}}
            <div class="absolute inset-y-0 left-1/2 transform -translate-x-1/2 hidden md:flex items-center space-x-4 font-medium">
                <a href="{{ url('/') }}" class="nav-link-underline-wrapper text-gray-800 hover:text-black px-3 py-2 text-sm transition-colors duration-300"><span class="nav-link-underline">Home</span></a>
                <a href="{{ route('gallery') }}" class="nav-link-underline-wrapper text-gray-800 hover:text-black px-3 py-2 text-sm transition-colors duration-300"><span class="nav-link-underline">My Gallery</span></a>
                <a href="{{ route('order') }}" class="nav-link-underline-wrapper text-gray-800 hover:text-black px-3 py-2 text-sm transition-colors duration-300"><span class="nav-link-underline">Order</span></a>
            </div>

            <!-- Kanan: Ikon Profil -->
            <div class="flex-shrink-0 px-6">
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex text-sm rounded-full focus:outline-none">
                            <svg class="h-8 w-8 text-gray-700 hover:text-black transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </a>
                            </form>
                        </div>
                    </div>
                @endauth
                @guest
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="text-gray-800 hover:text-black font-medium px-4 py-2 rounded-md text-sm transition-colors duration-300">Login</a>
                        <a href="{{ route('register') }}" class="bg-black text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-gray-800 transition-colors duration-300">Sign Up</a>
                    </div>
                @endguest
            </div>

        </div>
    </div>
</nav>

<div class="h-24"></div>