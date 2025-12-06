<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<style>
    /* === FIX NAVBAR === */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
    }

    /* === FIX SIDEBAR === */
    .sidebar {
        position: fixed;
        top: 56px; /* tinggi navbar */
        left: 0;
        width: 250px; /* sesuaikan dengan sidebar */
        height: calc(100vh - 56px);
        overflow-y: auto;
        background-color: #fff; /* atau tema sidebar kamu */
        border-right: 1px solid #ddd;
        z-index: 999;
    }

    /* === KONTEN UTAMA === */
    main {
        margin-top: 56px;   /* biar tidak ketutup navbar */
        margin-left: 250px; /* biar tidak ketutup sidebar */
        padding: 30px;
        flex-grow: 1;
        background: #f8f9fa; /* warna background dashboard */
        min-height: calc(100vh - 56px);
    }

    footer{
        margin-left:250px;
    }
</style>

<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar')

    <div class="d-flex">

        <!-- SIDEBAR -->
        @include('layouts.sidebar')

        <!-- KONTEN -->
        <main>
            @yield('content')
        </main>

    </div>

    @include('layouts.footer')
    @yield('scripts')
</body>
</html>
