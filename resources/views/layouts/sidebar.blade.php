<div id="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('img/logoae.png') }}" alt="Logo" class="sidebar-logo">
        <h6>Menu</h6>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('accounts.index') }}" class="{{ Request::routeIs('accounts.index', 'accounts.create', 'accounts.edit') ? 'active' : '' }}">
                <i class="bi bi-wallet2"></i> Akun Perkiraan
            </a>
        </li>
        <li>
            <a href="{{ route('journals.index') }}" class="{{ Request::routeIs('journals.index', 'journals.create', 'journals.edit', 'journals.show') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Jurnal Umum
            </a>
        </li>
        <li>
            <a href="{{ route('ledgers.index') }}" class="{{ Request::routeIs('ledgers.index') ? 'active' : '' }}">
                <i class="bi bi-book"></i> Buku Besar
            </a>
        </li>
        <li>
            <a href="{{ route('trial-balance') }}" class="{{ Request::routeIs('trial.balance') ? 'active' : '' }}">
                <i class="bi bi-calculator"></i> Neraca Saldo
            </a>
        </li>
        <li>
            <a href="{{ route('financial-reports.index') }}" class="{{ Request::routeIs('financial-reports.index', 'financial-reports.generate') ? 'active' : '' }}">
                <i class="bi bi-bar-chart"></i> Laporan Keuangan
            </a>
        </li>
    </ul>
</div>

<style>
#sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 235px;
    height: 100%;
    background: none;
    color: #5200b0;
    transition: all 0.3s ease;
}

.sidebar-header {
    text-align: center;
    padding: 25px;
    border-bottom: 3px solid rgba(255,255,255,0.2);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.sidebar-logo {
    width: 55px;
    height: auto;
}

.sidebar-header h6 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 700;
    color: #380670ff;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    color: #5200b0;
}

.sidebar-menu li {
    margin: 5px 0;
}

.sidebar-menu a {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    color: #380670ff;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
}

.sidebar-menu a i {
    margin-right: 20px;
    font-size: 1rem;
    transition: transform 0.3s ease;
    transform: scale(1);
}

.sidebar-menu a:hover {
    background-color: #ffffff26;
    padding-left: 25px;
    border-left: 5px solid #F3F6FF;
    box-shadow: inset 5px 0 10px #ffffff26;
    transition: all 0.3s ease;
    border-radius: 0 25px 25px 0;
}

.sidebar-menu a:hover i {
    transform: scale(1.5);
}

.sidebar-menu a.active {
    background-color: #ffffff29;
    border-left: 5px solid #F3F6FF;
    border-radius: 0 25px 25px 0;
    box-shadow: inset 5px 0 10px #ffffff26;
}

.sidebar-menu a.active i {
    transform: scale(1.5);
    transition: transform 0.3s ease;
}
</style>
