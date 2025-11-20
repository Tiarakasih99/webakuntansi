<!DOCTYPE html>
<html lang="en">
<html lang="en">
@include('layouts.head')
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar')
    <div class="d-flex">
        @include('layouts.sidebar')
        <main class="flex-grow-1 p-4" style="min-height: 100vh;">
            @yield('content')
        </main>
    </div>
    @include('layouts.footer')

    @stack('scripts')
</body>
</html>