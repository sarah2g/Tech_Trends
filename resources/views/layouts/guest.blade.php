<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <!-- ICONSCOUT CDN -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <!-- GOOGLE FONT(MONTSERATE) -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,800;1,700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('js/main.js') }}"></script>
    </head>
    <body class="font-sans antialiased">
        <nav>
            <div class="container nav__container">
                <a href="{{ url('/') }}" class="nav__logo">UNDEREMPLOYED</a>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>

        <footer>
            <div class="footer__copyright">
                <small>Copyright &copy; UnderEmployed</small>
            </div>
        </footer>
    </body>
</html>