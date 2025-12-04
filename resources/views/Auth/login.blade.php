<x-app-layout>
    <main>
        <div class="container mx-auto py-16 px-4">
            <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold text-center mb-6">Login</h1>
                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- Tampilkan pesan status sukses (misal: setelah registrasi) --}}
                @if (session('status'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    </div>
                    <!-- Password -->
                    <div class="mb-6" x-data="{ show: false }">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <div class="relative">
                            <input id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 pr-10" :type="show ? 'text' : 'password'" name="password" required />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" @click="show = !show" class="focus:outline-none">
                                    <svg x-show="!show" class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                    <svg x-show="show" style="display: none;" class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                            Login
                        </button>
                        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    </div>
                    <div class="mt-6 text-center">
                        <div class="relative flex items-center justify-center">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="bg-white px-2 text-gray-500">Or continue with</span>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-center space-x-4">
                            <a href="{{ route('login.google') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <img class="h-5 w-5 mr-2" src="https://www.svgrepo.com/show/355037/google.svg" alt="Google">
                                Google
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>

