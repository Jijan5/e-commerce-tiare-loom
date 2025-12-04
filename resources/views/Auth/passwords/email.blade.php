<x-app-layout>
    <main>
        <div class="container mx-auto py-16 px-4">
            <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold text-center mb-4">Forgot Your Password?</h1>
                <p class="text-center text-gray-600 mb-6">No problem. Just let us know your email address and we will email you a password reset link.</p>

                {{-- Tampilkan pesan status sukses (misal: link terkirim) --}}
                @if (session('status'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

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

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="w-full bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                            Email Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>
