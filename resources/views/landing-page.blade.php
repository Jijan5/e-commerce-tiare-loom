{{-- Menggunakan layout utama 'app.blade.php' --}}
<x-app-layout>
    {{-- Anda bisa mendefinisikan judul halaman yang spesifik di sini --}}
    <x-slot name="title">
        Selamat Datang di Tiare Loom
    </x-slot>

    {{-- Semua konten di bawah ini akan dimasukkan ke dalam '{{ $slot }}' di layout --}}
    <main>
        <div class="container mx-auto py-12">
            <h1 class="text-4xl font-bold text-center">Konten Landing Page Anda di Sini</h1>
            <p class="text-center mt-4">Mulai desain halaman utama Anda dari sini.</p>
        </div>
    </main>
</x-app-layout>