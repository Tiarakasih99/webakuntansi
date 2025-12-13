<nav class="navbar" style="background: none;">
    <div class="d-flex w-100 align-items-center justify-content-between px-3">
        <!-- Logo -->
        <a class="navbar-brand">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height:40px;">
        </a>

        <!-- Tombol logout selalu tampil di layar besar -->
        <form action="{{ route('logout') }}" method="POST" class="d-none d-lg-block m-0">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>
</nav>

<style>
    .navbar {
        width: (100%-250px);
        height: 50px;
    }

    .btn-danger {
        background: linear-gradient(90deg, #5d53a6, #8fa1e0);
        border: none;
        border-radius: 6px;
        font-weight: 600;
        padding: 4px 10px;
    }

    .btn-danger:hover{
        color: #000;
    }
</style>
