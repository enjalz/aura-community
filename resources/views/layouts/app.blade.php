<!DOCTYPE html>
{{-- Kerangka dasar semua halaman: memuat font, Bootstrap, dan CSS kita --}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Judul tab browser. Tiap halaman bisa mengisinya sendiri. --}}
    <title>@yield('title', 'Aura Community')</title>

    {{-- Font: Inter dan Source Serif 4 dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Source+Serif+4:wght@400;500&display=swap" rel="stylesheet">

    {{-- Bootstrap (versi dikunci) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- CSS buatan kita. Urutan penting: harus setelah Bootstrap. --}}
    <link href="{{ asset('css/variables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sections.css') }}" rel="stylesheet">

    {{-- Tempat CSS tambahan yang hanya dibutuhkan halaman tertentu (lewat @push('styles')) --}}
    @stack('styles')
</head>
<body>
    {{-- Tempat isi tiap halaman dimasukkan --}}
    @yield('content')

    {{-- JavaScript Bootstrap, dibutuhkan untuk menu hamburger di HP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Tempat JavaScript tambahan yang hanya dibutuhkan halaman tertentu (lewat @push('scripts')) --}}
    @stack('scripts')
</body>
</html>
