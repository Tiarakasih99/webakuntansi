<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<style>
    * {
        font-family: 'Poppins', sans-serif;
    }

    .navbar {
        position: relative;
        margin-left: 245px;
        top: 10px;
        margin-right: 10px;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 25px;
        width: 250px;
        z-index: 90;
    }

    main {
        margin-top: 35px;
        margin-left: 260px;
        margin-right: 25px;
        margin-bottom: 25px;
        padding: 30px;
        flex-grow: 1;
        min-height: calc(100vh - 55px);
        border-radius: 25px;
    
        /* Glassmorphism */
        background: rgba(255, 255, 255, 0.15); /* semi-transparent */
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .modal-open main {
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
    }
</style>

<body class="d-flex flex-column min-vh-100" style="background: url('/img/background.jpg'); background-size: cover; background-attachment: fixed;">
    @include('layouts.navbar')
    <div class="d-flex">
        @include('layouts.sidebar')
        <main>
            @yield('content')
        </main>
    </div>
    @include('layouts.footer')
    @yield('scripts')
</body>
</html>