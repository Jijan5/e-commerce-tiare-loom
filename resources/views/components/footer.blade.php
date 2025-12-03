<footer class="bg-white border-t-5 border-black">
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            <!-- Logo and About -->
            <div class="md:col-span-1">
                <img class="h-30 mx-auto md:mx-0" src="{{ asset('images/tiare-logo.jpg') }}" alt="Tiare Loom Logo">
                <h3 class="text-xl font-bold text-gray-900">Tiare Loom</h3>
                <p class="mt-2 text-base text-gray-500">
                    Crafting unique, handmade beads bags with passion and precision.
                </p>
            </div>

            <!-- Spacer -->
            <div class="hidden md:block"></div>

            <!-- Social Links -->
            <div class="md:col-span-1 md:justify-self-end">
                <h3 class="font-semibold text-gray-900">Follow Us</h3>
                <div class="flex justify-center md:justify-start space-x-6 mt-4">
                    {{-- Ganti '#' dengan link Instagram Anda --}}
                    <a href="{{ 'https://www.instagram.com/tiareloom?igsh=MWp5NjNqeGJ6anBqcQ==' }}"
                        class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Instagram</span>
                        {{-- SVG Ikon Instagram --}}
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-12 border-t border-gray-200 pt-8">
            <p class="text-base text-gray-400 text-center">&copy; 2020 Tiare Loom. All Rights Reserved.</p>
        </div>
    </div>
</footer>
