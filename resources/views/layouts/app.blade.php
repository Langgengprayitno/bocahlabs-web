<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'BocahLabs — Website Development Service')</title>

    @stack('meta')

    {{-- Memuat font Inter resmi (perbaikan bug prototipe) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />

    {{-- Skrip anti-flash tema: jalankan sebelum halaman dirender --}}
    <script>
        (function () {
            try {
                var savedTheme = localStorage.getItem('bocahlabs_theme');
                if (savedTheme === 'light') {
                    document.documentElement.classList.remove('dark');
                } else {
                    document.documentElement.classList.add('dark');
                }
            } catch (_) {}
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900 dark:bg-slatebg-950 dark:text-slate-100 transition-colors duration-300 overflow-x-hidden">
    @yield('content')

    @stack('scripts')
</body>
</html>