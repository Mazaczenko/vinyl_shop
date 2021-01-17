<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('shared.icons')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('css_after')
    <title>@yield('title', 'The Vinyl Shop')</title>

</head>
<body>

    @include('shared.navigation')

    <main class="container mt-3">
        @yield('main')
    </main>

    @include('shared.footer')

    <script src="{{ mix('js/app.js') }}"></script>
    @yield('script_after')
</body>
</html>
