<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<style>
    .navbar {
        position: fixed;
        margin-left: 275px;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
    }

    .sidebar {
        position: fixed;
        top: 55px;
        left: 0;
        width: 250px;
        height: calc(100vh - 55px);
        overflow-y: auto;
        background-color: #fff;
        border-right: 1px solid #ddd;
        z-index: 999;
    }

    main {
        margin-top: 55px;
        margin-left: 260px;
        padding: 30px;
        flex-grow: 1;
        background: #f8f9fa;
        min-height: calc(100vh - 55px);
    }

    footer{
        margin-left:250px;
    }
</style>

<body class="d-flex flex-column min-vh-100">
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