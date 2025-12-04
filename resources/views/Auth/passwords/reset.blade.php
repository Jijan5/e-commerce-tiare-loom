<x-app-layout>
    <main>
        <div class="container mx-auto py-16 px-4">
            <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold text-center mb-6">Reset Password</h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                        <input id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" type="password" name="password" required />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                        <input id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" type="password" name="password_confirmation" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="w-full bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>

