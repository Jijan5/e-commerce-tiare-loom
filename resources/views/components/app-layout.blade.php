@props(['hideNavbar' => false])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('images/tiare-logo.jpg') }}"
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    {{-- Judul halaman akan dinamis --}}
    {{-- <title>{{ $title ?? 'Tiare Loom' }}</title> --}}

    {{-- Ini adalah tempat untuk mengimpor CSS, seperti Tailwind --}}
    @vite('resources/css/app.css')

    {{-- Alpine.js untuk interaktivitas seperti dropdown --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-70">

    {{-- Memanggil komponen navbar yang sudah kita buat --}}
    @if (!$hideNavbar)
        <x-navbar />
    @endif

    {{-- Ini adalah "slot" dimana konten spesifik halaman akan dimasukkan --}}
    {{ $slot }}

    {{-- Memanggil komponen footer yang baru dibuat --}}
    <x-footer />

</body>
</html>