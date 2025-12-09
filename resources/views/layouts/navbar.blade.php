<nav class="navbar navbar-expand-lg shadow-sm fixed-top" style="background: linear-gradient(90deg, #594D9B, #C8CDEA);">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height:40px; justify-content: right;">
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
</nav>

<style>
.navbar-toggler {
    border-color: white;
}

.navbar .nav-link {
    font-weight: 500;
}

.dropdown-menu {
    border-radius: 10px;
}

.navbar {
    width: calc(100% - 275px);
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    height: 55px;
}
</style>