<x-admin-layout>
    <h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>
    <p class="mt-2 text-gray-600">Welcome to the admin panel, {{ Auth::guard('admin')->user()->name }}.</p>

    {{-- Container untuk card statistik --}}
    <div class="mt-6">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Card 1: Data Orderan --}}
            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        {{-- Menampilkan orderan pending --}}
                        <p class="text-2xl font-bold text-gray-800">{{ $ordersPending ?? 0 }}</p>
                        <p class="text-sm font-medium text-gray-500">Orderan Masuk</p>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 2: Orderan Dikerjakan --}}
            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        {{-- Menampilkan orderan dikerjakan --}}
                        <p class="text-2xl font-bold text-gray-800">{{ $ordersDikerjakan ?? 0 }}</p>
                        <p class="text-sm font-medium text-gray-500">Orderan Dikerjakan</p>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-yellow-100 rounded-full">
                        <svg class="w-6 h-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 3: Orderan Dikirim --}}
            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        {{-- Menampilkan orderan yang sudah dikirim --}}
                        <p class="text-2xl font-bold text-gray-800">{{ $ordersDikirim ?? 0 }}</p>
                        <p class="text-sm font-medium text-gray-500">Orderan Dikirim</p>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-indigo-100 rounded-full">
                        <svg class="w-6 h-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 17H6a1 1 0 01-1-1V7a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1h-1m-6 0l-3 3m0 0l-3-3m3 3V6">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 4: Orderan Selesai --}}
            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        {{-- Menampilkan orderan yang sudah selesai --}}
                        <p class="text-2xl font-bold text-gray-800">{{ $ordersSelesai ?? 0 }}</p>
                        <p class="text-sm font-medium text-gray-500">Orderan Selesai</p>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                        <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            {{-- Card 5: Orderan Dibatalkan --}}
            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        {{-- Menampilkan orderan yang dibatalkan --}}
                        <p class="text-2xl font-bold text-gray-800">{{ $ordersDibatalkan ?? 0 }}</p>
                        <p class="text-sm font-medium text-gray-500">Orderan Dibatalkan</p>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full">
                        <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>

