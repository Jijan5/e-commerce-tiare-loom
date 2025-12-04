<style>
    .nav-link-underline-wrapper .nav-link-underline {
        position: relative;
        display: inline-block;
    }

    .nav-link-underline-wrapper .nav-link-underline::after {
        content: '';
        position: absolute;
        bottom: -4px;
        /* Atur jarak garis dari teks */
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background-color: #c5b358;
        /* Warna emas */
        transition: width 0.3s ease-in-out;
    }

    .nav-link-underline-wrapper:hover .nav-link-underline::after {
        width: 100%;
    }
</style>
<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Wrapper untuk glass effect dan rounded shape --}}
        <div
            class="relative flex items-center justify-between h-20 bg-white/50 backdrop-blur-lg shadow-lg rounded-full mt-4 border border-white/50">

            <!-- Kiri: Logo / Ikon -->
            <div class="flex-shrink-0 px-6">
                <a href="{{ url('/') }}">
                    {{-- Pastikan file icon.png ada di folder public/images/ --}}
                    <img class="h-20 w-auto" src="{{ asset('images/tiare-logo.png') }}" alt="Tiare Loom Logo">
                </a>
            </div>

            <!-- Tengah: Link Navigasi -->
            {{-- Menggunakan absolute positioning untuk memastikan menu selalu di tengah --}}
            <div
                class="absolute inset-y-0 left-1/2 transform -translate-x-1/2 hidden md:flex items-center space-x-4 font-medium">
                <a href="{{ url('/') }}"
                    class="nav-link-underline-wrapper text-gray-800 hover:text-black px-3 py-2 text-sm transition-colors duration-300"><span
                        class="nav-link-underline">Home</span></a>
                <a href="{{ route('gallery') }}"
                    class="nav-link-underline-wrapper text-gray-800 hover:text-black px-3 py-2 text-sm transition-colors duration-300"><span
                        class="nav-link-underline">My Gallery</span></a>
                <a href="{{ route('order') }}"
                    class="nav-link-underline-wrapper text-gray-800 hover:text-black px-3 py-2 text-sm transition-colors duration-300"><span
                        class="nav-link-underline">Order</span></a>
            </div>

            <!-- Kanan: Ikon Profil -->
            <div class="hidden md:flex flex-shrink-0 items-center px-6">
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex text-sm rounded-full focus:outline-none">
                            <svg class="h-8 w-8 text-gray-700 hover:text-black transition-colors duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </a>
                            </form>
                        </div>
                    </div>
                @endauth
                @guest
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('login') }}"
                            class="text-gray-800 hover:text-black font-medium px-4 py-2 rounded-md text-sm transition-colors duration-300">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-black text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-gray-800 transition-colors duration-300">Sign
                            Up</a>
                    </div>
                @endguest
            </div>
            <!-- Hamburger Menu Button (Mobile) -->
            <div class="md:hidden flex items-center px-6">
                <button @click="open = true"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-black hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Sidebar Menu -->
    <div x-show="open" x-cloak class="md:hidden">
        <div @click="open = false" class="fixed inset-0 bg-black/25 z-40"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <div class="fixed inset-y-0 right-0 max-w-xs w-full bg-white z-50 p-6"
            x-transition:enter="transform transition ease-out duration-300"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in duration-200" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full">

            <div class="flex items-center justify-between mb-8">
                <h2 class="text-lg font-semibold">Menu</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700 p-1 rounded-full -mr-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="flex flex-col space-y-4">
                <a href="{{ url('/') }}" class="text-gray-800 hover:text-black py-2 text-base">Home</a>
                <a href="{{ route('gallery') }}" class="text-gray-800 hover:text-black py-2 text-base">My Gallery</a>
                <a href="{{ route('order') }}" class="text-gray-800 hover:text-black py-2 text-base">Order</a>
                <hr class="my-4">
                @auth
                    <a href="{{ route('profile.edit') }}" class="text-gray-800 hover:text-black py-2 text-base">Your
                        Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="w-full text-left text-gray-800 hover:text-black py-2 text-base">Logout</a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-800 hover:text-black py-2 text-base">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-black text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-gray-800 transition-colors duration-300 text-center">Sign
                        Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="h-24"></div>
