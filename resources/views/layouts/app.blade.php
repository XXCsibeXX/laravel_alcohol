<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kezdőlap') – Alkohol Katalógus</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🍷</text></svg>">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-mark"><x-icon name="wine" /></span>
                <span>Alkohol Katalógus</span>
            </a>

            <button type="button" class="nav-toggle" data-nav-toggle aria-label="Menü megnyitása">
                <x-icon name="menu" />
            </button>

            @include('layouts.navigation')
        </div>
    </header>

    <main class="container page">
        @include('partials.flash')

        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>Alkohol Katalógus &copy; {{ date('Y') }} &middot; PHP v{{ PHP_VERSION }}</p>
            <p class="small">Az alkohol fogyasztása 18 éven aluliaknak tilos. Fogyassza mértékkel!</p>
        </div>
    </footer>
</body>
</html>
