<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar')

    <div class="d-flex" style="min-height: 100vh;">
        
        <!-- SIDEBAR -->
        @include('layouts.sidebar')

        <!-- KONTEN -->
        <main class="flex-grow-1 p-4 bg-light">
            @yield('content')
        </main>

    </div>

    @include('layouts.footer')
    @yield('scripts')
</body>
</html>
