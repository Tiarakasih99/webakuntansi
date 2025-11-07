<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Web Akuntansi')</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom CSS tambahan --}}
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #fff;
            border-right: 1px solid #dee2e6;
        }
        .sidebar a {
            color: #495057;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: #0d6efd;
        }
        .sidebar .submenu {
            margin-left: 1.5rem;
        }
    </style>
</head>
<body>

<div class="d-flex">
    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Konten kanan --}}
    <div class="flex-grow-1 d-flex flex-column">
        {{-- Navbar --}}
        @include('layouts.navbar')

        {{-- Konten utama --}}
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('layouts.footer')
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
