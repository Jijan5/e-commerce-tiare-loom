<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Tiare Loom</title>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 ease-in-out transform bg-gray-800 lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <img class="h-12 w-auto" src="{{ asset('images/tiare-logo.jpg') }}" alt="Logo">
                    <span class="ml-3 text-xl font-bold text-white">Admin Panel</span>
                </div>
            </div>
            <nav class="mt-10">
                <a class="flex items-center px-6 py-3 mt-4 text-gray-100 bg-gray-700" href="{{ route('admin.dashboard') }}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a class="flex items-center px-6 py-3 mt-4 text-gray-400 hover:bg-gray-700 hover:text-gray-100" href="#">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    <span class="mx-3">Data Orderan</span>
                </a>
                <a class="flex items-center px-6 py-3 mt-4 text-gray-400 hover:bg-gray-700 hover:text-gray-100" href="#">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <span class="mx-3">Orderan Dikerjakan</span>
                </a>
                <a class="flex items-center px-6 py-3 mt-4 text-gray-400 hover:bg-gray-700 hover:text-gray-100" href="#">
                     <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17H6a1 1 0 01-1-1V7a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1h-1m-6 0l-3 3m0 0l-3-3m3 3V6"></path></svg>
                    <span class="mx-3">Orderan Dikirim</span>
                </a>
                <a class="flex items-center px-6 py-3 mt-4 text-gray-400 hover:bg-gray-700 hover:text-gray-100" href="#">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="mx-3">Orderan Selesai</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b-2 border-gray-200">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center">
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="relative flex items-center p-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none">
                            <span>{{ Auth::guard('admin')->user()->name }}</span>
                            <svg class="w-5 h-5 ml-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>

                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full" style="display: none;"></div>

                        <div x-show="dropdownOpen" class="absolute right-0 z-20 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl" style="display: none;">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-700 hover:text-white">Logout</a>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>

