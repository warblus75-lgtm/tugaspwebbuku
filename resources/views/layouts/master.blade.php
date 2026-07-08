<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'TugasPWebBuku')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Utama -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- CSS Khusus Halaman -->
    @yield('css')
</head>

<body>

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Isi Halaman -->
    <main class="container py-5">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS Utama -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- JS Khusus Halaman -->
    @yield('js')

</body>

</html>