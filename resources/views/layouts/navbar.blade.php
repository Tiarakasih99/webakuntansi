<nav class="navbar navbar-expand-lg shadow-sm fixed-top"
    style="background: linear-gradient(90deg, #cfc3f1, #b8c5f3, #a4b8f2);">

    <div class="container-fluid">
        <a class="navbar-brand text-white fw-bold" href="{{ url('/') }}">
            <i class="bi bi-calculator me-2"></i> Adeste & Co.
        </a>

        <button class="navbar-toggler text-white border-white" type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" role="button" 
                       data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i> Hai, User
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
        <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger btn-sm">Logout</button>
    </form>

</nav>
<style>
.navbar {
    background: linear-gradient(90deg,
                rgba(207,195,241,0.45),
                rgba(184,197,243,0.45),
                rgba(164,184,242,0.45));
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border-bottom: 1px solid rgba(255,255,255,0.35);
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
}

.navbar-toggler {
    border-color: white;
}

.navbar .nav-link,
.navbar-brand {
    font-weight: 500;
    color: #1c1c2d !important; /* biar kontras */
}

.dropdown-menu {
    border-radius: 12px;
    backdrop-filter: blur(15px);
    background: rgba(255,255,255,0.70);
    border: 1px solid rgba(255,255,255,0.4);
}
</style>
