<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('images/tiare-logo.jpg') }}"

    {{-- Judul halaman akan dinamis --}}
    <title>{{ $title ?? 'Tiare Loom' }}</title>

    {{-- Ini adalah tempat untuk mengimpor CSS, seperti Tailwind --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    {{-- Memanggil komponen navbar yang sudah kita buat --}}
    <x-navbar />

    {{-- Ini adalah "slot" dimana konten spesifik halaman akan dimasukkan --}}
    {{ $slot }}

</body>
</html>