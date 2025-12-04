<x-app-layout :hide-navbar="true">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <main>
        <section class="container mx-auto pt-8 pb-16 px-4 sm:px-6 lg:px-8">
            {{-- Tombol Kembali ke Home --}}
            <div class="mb-8">
                <a href="{{ url('/') }}"
                    class="inline-flex items-center text-gray-600 hover:text-black transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Home
                </a>
            </div>
            <h1 class="text-4xl font-bold text-center mb-12">{{ __('profile.my_account') }}</h1>

            <div class="max-w-7xl mx-auto" x-data="{ tab: '{{ session('tab', 'profile') }}', sidebarOpen: false }">
                <!-- Mobile Sidebar Toggle -->
                <div class="md:hidden mb-6">
                    <button @click="sidebarOpen = true"
                        class="flex items-center text-gray-600 hover:text-black p-2 rounded-md -ml-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span class="ml-2 font-semibold text-lg">Menu</span>
                    </button>
                </div>
                <div class="md:grid md:grid-cols-4 md:gap-10">
                    <!-- Desktop Sidebar -->
                    <div class="hidden md:block md:col-span-1">
                        <div class="flex flex-col space-y-2 border-r border-gray-200 pr-4">
                            <button @click="tab = 'profile'"
                                :class="tab === 'profile' ? 'bg-gray-200 text-gray-900' :
                                    'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                                class="w-full text-left px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                {{ __('profile.profile') }}
                            </button>
                            <button @click="tab = 'address'"
                                :class="tab === 'address' ? 'bg-gray-200 text-gray-900' :
                                    'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                                class="w-full text-left px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                {{ __('profile.address') }}
                            </button>
                            <button @click="tab = 'my-orders'"
                                :class="tab === 'my-orders' ? 'bg-gray-200 text-gray-900' :
                                    'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                                class="w-full text-left px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                {{ __('profile.my_order') }}
                            </button>
                            <button @click="tab = 'history'"
                                :class="tab === 'history' ? 'bg-gray-200 text-gray-900' :
                                    'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                                class="w-full text-left px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                {{ __('profile.history_order') }}
                            </button>
                            <button @click="tab = 'security'"
                                :class="tab === 'security' ? 'bg-gray-200 text-gray-900' :
                                    'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                                class="w-full text-left px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                {{ __('profile.security') }}
                            </button>

                            {{-- Language Switcher
                            <div class="pt-4 mt-4 border-t">
                                <div class="flex justify-center items-center space-x-2">
                                    <a href="{{ route('language.switch', 'id') }}"
                                        class="px-3 py-1 rounded-md text-sm {{ app()->getLocale() == 'id' ? 'font-bold text-black bg-gray-200' : 'text-gray-500 hover:bg-gray-100' }}">ID</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="{{ route('language.switch', 'en') }}"
                                        class="px-3 py-1 rounded-md text-sm {{ app()->getLocale() == 'en' ? 'font-bold text-black bg-gray-200' : 'text-gray-500 hover:bg-gray-100' }}">EN</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Mobile Sidebar (Off-canvas) -->
                    <div x-show="sidebarOpen" class="fixed inset-0 flex z-40 md:hidden" x-cloak>
                        <!-- Overlay -->
                        <div @click="sidebarOpen = false" class="fixed inset-0 bg-gray-600/75"
                            x-transition:enter="transition-opacity ease-linear duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition-opacity ease-linear duration-300"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

                        <!-- Sidebar Panel -->
                        <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white"
                            x-transition:enter="transition ease-in-out duration-300 transform"
                            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                            x-transition:leave="transition ease-in-out duration-300 transform"
                            x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button @click="sidebarOpen = false"
                                    class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                                    <span class="sr-only">Close sidebar</span>
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                                <div class="flex-shrink-0 flex items-center px-4">
                                    <h2 class="text-xl font-bold">{{ __('profile.my_account') }}</h2>
                                </div>
                                <nav class="mt-5 px-2 space-y-1">
                                    <button @click="tab = 'profile'; sidebarOpen = false"
                                        :class="tab === 'profile' ? 'bg-gray-200 text-gray-900' :
                                            'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                                        class="w-full text-left group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                        {{ __('profile.profile') }}
                                    </button>
                                    <button @click="tab = 'address'; sidebarOpen = false"
                                        :class="tab === 'address' ? 'bg-gray-200 text-gray-900' :
                                            'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                                        class="w-full text-left group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                        {{ __('profile.address') }}
                                    </button>
                                    <button @click="tab = 'my-orders'; sidebarOpen = false"
                                        :class="tab === 'my-orders' ? 'bg-gray-200 text-gray-900' :
                                            'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                                        class="w-full text-left group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                        {{ __('profile.my_order') }}
                                    </button>
                                    <button @click="tab = 'history'; sidebarOpen = false"
                                        :class="tab === 'history' ? 'bg-gray-200 text-gray-900' :
                                            'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                                        class="w-full text-left group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                        {{ __('profile.history_order') }}
                                    </button>
                                    <button @click="tab = 'security'; sidebarOpen = false"
                                        :class="tab === 'security' ? 'bg-gray-200 text-gray-900' :
                                            'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                                        class="w-full text-left group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                        {{ __('profile.security') }}
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Konten --}}
                    <div class="md:col-span-3 mt-8 md:mt-0">
                        {{-- Konten: Profile --}}
                        <div x-show="tab === 'profile'" x-cloak x-data="{ editingProfile: {{ $errors->any() && old('from_form') === 'profile' ? 'true' : 'false' }} }">
                            {{-- Tampilan Info Profil --}}
                            <div x-show="!editingProfile" class="bg-white shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    @if (session('status') === 'profile-details-updated')
                                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                            role="alert">
                                            <span class="block sm:inline">{{ __('profile.profile_updated') }}</span>
                                        </div>
                                    @endif
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                {{ __('profile.profile_info') }}
                                            </h3>
                                            <dl class="mt-4 space-y-4">
                                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-x-4">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        {{ __('profile.full_name') }}
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-3">
                                                        {{ $user->nama }}</dd>
                                                </div>
                                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-x-4">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        {{ __('profile.email') }}
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-3">
                                                        {{ $user->email }}</dd>
                                                </div>
                                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-x-4">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        {{ __('profile.phone_number') }}
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-3">
                                                        {{ $user->no_hp ?? '-' }}</dd>
                                                </div>
                                            </dl>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <button @click="editingProfile = true" type="button"
                                                class="bg-black text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-gray-800 transition-colors duration-300">
                                                {{ __('profile.edit') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Form Edit Profil --}}
                            <form x-show="editingProfile" x-cloak action="{{ route('profile.update.details') }}"
                                method="POST" class="bg-white shadow sm:rounded-lg">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="from_form" value="profile">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        {{ __('profile.profile_info') }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ __('profile.profile_info_desc') }}
                                    </p>

                                    <div class="mt-6 space-y-6">
                                        <div>
                                            <label for="nama" class="block text-sm font-medium text-gray-700">
                                                {{ __('profile.full_name') }}
                                            </label>
                                            <input type="text" name="nama" id="nama"
                                                class="py-2 px-3 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                value="{{ old('nama', $user->nama) }}" required>
                                        </div>
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700">
                                                {{ __('profile.email') }}
                                            </label>
                                            <input type="email" name="email" id="email"
                                                class="py-2 px-3 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                value="{{ old('email', $user->email) }}" required>
                                        </div>
                                        <div>
                                            <label for="no_hp" class="block text-sm font-medium text-gray-700">
                                                {{ __('profile.phone_number') }}
                                            </label>
                                            <input type="text" name="no_hp" id="no_hp"
                                                class="py-2 px-3 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                value="{{ old('no_hp', $user->no_hp) }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 rounded-b-lg">
                                    <button type="button" @click="editingProfile = false"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        {{ __('profile.cancel') }}
                                    </button>
                                    <button type="submit"
                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800">
                                        {{ __('profile.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Konten: Alamat --}}
                        <div x-show="tab === 'address'" x-cloak x-data="{ editingAddress: {{ $errors->any() && old('from_form') === 'address' ? 'true' : 'false' }} }">
                            {{-- Tampilan Kartu Alamat --}}
                            <div x-show="!editingAddress" class="bg-white shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                {{ __('profile.shipping_address') }}
                                            </h3>
                                            @if (session('status') === 'profile-address-updated')
                                                <div x-data="{ show: true }" x-show="show" x-transition
                                                    x-init="setTimeout(() => show = false, 3000)"
                                                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-4"
                                                    role="alert">
                                                    <span
                                                        class="block sm:inline">{{ __('profile.address_updated') }}</span>
                                                </div>
                                            @endif
                                            @if ($user->alamat)
                                                <address class="mt-2 max-w-xl text-sm text-gray-500 not-italic">
                                                    {{ $user->alamat }}, {{ $user->rt_rw }} <br>
                                                    {{ $user->desa_kelurahan }}, {{ $user->kecamatan }} <br>
                                                    {{ $user->kota_kabupaten }}, {{ $user->provinsi }}
                                                    {{ $user->kode_pos }}
                                                </address>
                                            @else
                                                <p class="mt-2 text-sm text-gray-500">{{ __('profile.no_address') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <button @click="editingAddress = true" type="button"
                                                class="bg-black text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-gray-800 transition-colors duration-300">
                                                {{ $user->alamat ? __('profile.edit_address') : __('profile.add_address') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Form Edit Alamat --}}
                            <form x-show="editingAddress" x-cloak action="{{ route('profile.update.address') }}"
                                method="POST" class="bg-white shadow sm:rounded-lg">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="from_form" value="address">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        {{ __('profile.address_details') }}</h3>
                                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                        <div class="sm:col-span-6">
                                            <label for="alamat"
                                                class="block text-sm font-medium text-gray-700">{{ __('profile.address_street') }}</label>
                                            <input type="text" name="alamat" id="alamat"
                                                class="py-2 px-3 mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                value="{{ old('alamat', $user->alamat) }}" required>
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label for="rt_rw"
                                                class="block text-sm font-medium text-gray-700">{{ __('profile.rt_rw') }}</label>
                                            <input type="text" name="rt_rw" id="rt_rw"
                                                class="py-2 px-3 mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                value="{{ old('rt_rw', $user->rt_rw) }}" required>
                                        </div>
                                        <div class="sm:col-span-4">
                                            <label for="kode_pos"
                                                class="block text-sm font-medium text-gray-700">{{ __('profile.postal_code') }}</label>
                                            <input type="text" name="kode_pos" id="kode_pos"
                                                class="py-2 px-3 mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                value="{{ old('kode_pos', $user->kode_pos) }}" required>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label for="provinsi"
                                                class="block text-sm font-medium text-gray-700">{{ __('profile.province') }}</label>
                                            <select id="provinsi" name="provinsi"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm sm:text-sm"
                                                required>
                                                <option value="">{{ __('profile.choose_province') }}</option>
                                            </select>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label for="kota_kabupaten"
                                                class="block text-sm font-medium text-gray-700">{{ __('profile.city_district') }}</label>
                                            <select id="kota_kabupaten" name="kota_kabupaten"
                                                class="mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm sm:text-sm"
                                                required disabled>
                                                <option value="">{{ __('profile.choose_city') }}</option>
                                            </select>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label for="kecamatan"
                                                class="block text-sm font-medium text-gray-700">{{ __('profile.subdistrict') }}</label>
                                            <select id="kecamatan" name="kecamatan"
                                                class="mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm sm:text-sm"
                                                required disabled>
                                                <option value="">{{ __('profile.choose_subdistrict') }}</option>
                                            </select>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label for="desa_kelurahan"
                                                class="block text-sm font-medium text-gray-700">{{ __('profile.village_ward') }}</label>
                                            <select id="desa_kelurahan" name="desa_kelurahan"
                                                class="mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm sm:text-sm"
                                                required disabled>
                                                <option value="">{{ __('profile.choose_village') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 rounded-b-lg">
                                    <button type="button" @click="editingAddress = false"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('profile.cancel') }}</button>
                                    <button type="submit"
                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800">{{ __('profile.save_address') }}</button>
                                </div>
                            </form>
                        </div>

                        {{-- Konten: My Order --}}
                        <div x-show="tab === 'my-orders'" x-cloak>
                            <div class="bg-white shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        {{ __('profile.my_order') }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ __('profile.my_order_desc') }}</p>
                                    <div class="mt-6 space-y-4">
                                        @forelse ($activeOrders as $order)
                                            <a href="{{ route('order.success', $order) }}"
                                                class="block border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <p class="font-bold text-gray-800">Order
                                                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $order->created_at->format('d F Y, H:i') }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        @empty
                                            <p class="text-sm text-gray-500">{{ __('profile.no_active_orders') }}</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Konten: History Order --}}
                        <div x-show="tab === 'history'" x-cloak>
                            <div class="bg-white shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        {{ __('profile.history_order') }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ __('profile.history_order_desc') }}</p>
                                    <div class="mt-6 space-y-4">
                                        @forelse ($completedOrders as $order)
                                            <a href="{{ route('order.success', $order) }}"
                                                class="block border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <p class="font-bold text-gray-800">Order
                                                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $order->created_at->format('d F Y, H:i') }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        @empty
                                            <p class="text-sm text-gray-500">{{ __('profile.no_completed_orders') }}
                                            </p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Konten: Security --}}
                        <div x-show="tab === 'security'" x-cloak>
                            <form action="{{ route('profile.update.password') }}" method="POST"
                                class="bg-white shadow sm:rounded-lg">
                                @csrf
                                @method('patch')
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        {{ __('profile.update_password') }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ __('profile.update_password_desc') }}</p>

                                    {{-- Hanya tampilkan form jika user punya password (tidak login via Google) --}}
                                    @if ($user->password)
                                        <div class="mt-6 space-y-6">
                                            <div>
                                                <label for="current_password"
                                                    class="block text-sm font-medium text-gray-700">{{ __('profile.current_password') }}</label>
                                                <input type="password" name="current_password" id="current_password"
                                                    class="py-2 px-3 mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                    required>
                                                @error('current_password', 'updatePassword')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="password"
                                                    class="block text-sm font-medium text-gray-700">{{ __('profile.new_password') }}</label>
                                                <input type="password" name="password" id="password"
                                                    class="py-2 px-3 mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                    required>
                                                @error('password', 'updatePassword')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="password_confirmation"
                                                    class="block text-sm font-medium text-gray-700">{{ __('profile.confirm_password') }}</label>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation"
                                                    class="py-2 px-3 mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                    required>
                                            </div>
                                        </div>
                                    @else
                                        <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-400">
                                            <p class="text-sm text-yellow-700">You logged in using a social account, so
                                                you don't have a password to change.</p>
                                        </div>
                                    @endif
                                </div>
                                @if ($user->password)
                                    <div
                                        class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 rounded-b-lg">
                                        @if (session('status') === 'password-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition
                                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 mr-3">
                                                {{ __('profile.password_updated') }}</p>
                                        @endif
                                        <button type="submit"
                                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800">
                                            {{ __('profile.save') }}
                                        </button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userAddress = {
                provinsi: '{{ old('provinsi', $user->provinsi) }}',
                kota: '{{ old('kota_kabupaten', $user->kota_kabupaten) }}',
                kecamatan: '{{ old('kecamatan', $user->kecamatan) }}',
                desa: '{{ old('desa_kelurahan', $user->desa_kelurahan) }}'
            };
            const hasAddress = !!userAddress.provinsi;

            const apiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/';
            const provinsiSelect = document.getElementById('provinsi');
            const kotaSelect = document.getElementById('kota_kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const desaSelect = document.getElementById('desa_kelurahan');

            function resetAndDisable(selectElement, defaultOptionText) {
                selectElement.innerHTML = `<option value="">${defaultOptionText}</option>`;
                selectElement.disabled = true;
            }

            async function populateSelect(selectElement, url, selectedValue = null) {
                try {
                    const response = await fetch(url);
                    if (!response.ok) throw new Error(`Failed to fetch ${url}`);
                    const data = await response.json();

                    const defaultOptionText = selectElement.querySelector('option').textContent;
                    selectElement.innerHTML = `<option value="">${defaultOptionText}</option>`;

                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.name;
                        option.dataset.id = item.id;
                        option.textContent = item.name;
                        selectElement.appendChild(option);
                    });

                    selectElement.disabled = false;

                    if (selectedValue) {
                        selectElement.value = selectedValue;
                    }

                    return selectElement.options[selectElement.selectedIndex]?.dataset.id;
                } catch (error) {
                    console.error('Error populating dropdown:', error);
                    return null;
                }
            }

            provinsiSelect.addEventListener('change', function() {
                resetAndDisable(kotaSelect, '{{ __('profile.choose_city') }}');
                resetAndDisable(kecamatanSelect, '{{ __('profile.choose_subdistrict') }}');
                resetAndDisable(desaSelect, '{{ __('profile.choose_village') }}');
                const provinsiId = this.options[this.selectedIndex].dataset.id;
                if (provinsiId) {
                    populateSelect(kotaSelect, `${apiBaseUrl}regencies/${provinsiId}.json`);
                }
            });

            kotaSelect.addEventListener('change', function() {
                resetAndDisable(kecamatanSelect, '{{ __('profile.choose_subdistrict') }}');
                resetAndDisable(desaSelect, '{{ __('profile.choose_village') }}');
                const kotaId = this.options[this.selectedIndex].dataset.id;
                if (kotaId) {
                    populateSelect(kecamatanSelect, `${apiBaseUrl}districts/${kotaId}.json`);
                }
            });

            kecamatanSelect.addEventListener('change', function() {
                resetAndDisable(desaSelect, '{{ __('profile.choose_village') }}');
                const kecamatanId = this.options[this.selectedIndex].dataset.id;
                if (kecamatanId) {
                    populateSelect(desaSelect, `${apiBaseUrl}villages/${kecamatanId}.json`);
                }
            });

            async function initializeAddress() {
                // Cek jika ada old input (karena validation error) atau data user
                const initialProvinsi = userAddress.provinsi;
                const initialKota = userAddress.kota;
                const initialKecamatan = userAddress.kecamatan;
                const initialDesa = userAddress.desa;

                if (initialProvinsi) {
                    const provinsiId = await populateSelect(provinsiSelect, `${apiBaseUrl}provinces.json`,
                        initialProvinsi);
                    if (provinsiId && initialKota) {
                        const kotaId = await populateSelect(kotaSelect,
                            `${apiBaseUrl}regencies/${provinsiId}.json`, initialKota);
                        if (kotaId && initialKecamatan) {
                            const kecamatanId = await populateSelect(kecamatanSelect,
                                `${apiBaseUrl}districts/${kotaId}.json`, initialKecamatan);
                            if (kecamatanId && initialDesa) {
                                await populateSelect(desaSelect, `${apiBaseUrl}villages/${kecamatanId}.json`,
                                    initialDesa);
                            }
                        }
                    }
                } else {
                    populateSelect(provinsiSelect, `${apiBaseUrl}provinces.json`);
                }
            }

            initializeAddress();
        });
    </script>
</x-app-layout>
