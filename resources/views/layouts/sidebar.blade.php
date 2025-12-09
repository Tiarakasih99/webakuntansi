<div id="sidebar">
    <div class="sidebar-header">
        <h5>Admin Panel</h5>
        <h6>Menu</h6>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('accounts.index') }}" class="{{ Request::routeIs('accounts.index') ? 'active' : '' }}">
                <i class="bi bi-wallet2"></i> Akun Perkiraan
            </a>
        </li>
        <li>
            <a href="{{ route('journals.index') }}" class="{{ Request::routeIs('journals.index') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Jurnal Umum
            </a>
        </li>
        <li>
            <a href="{{ route('journals.adjustment') }}" class="{{ Request::routeIs('journals.adjustment') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check"></i> Jurnal Penyesuaian
            </a>
        </li>
        <li>
            <a href="{{ route('ledgers.index') }}" class="{{ Request::routeIs('ledgers.index') ? 'active' : '' }}">
                <i class="bi bi-book"></i> Buku Besar
            </a>
        </li>
        <li>
            <a href="{{ route('trial.balance') }}" class="{{ Request::routeIs('trial.balance') ? 'active' : '' }}">
                <i class="bi bi-calculator"></i> Neraca Saldo
            </a>
        </li>
        <li>
            <a href="{{ route('financial-reports.index') }}" class="{{ Request::routeIs('financial-reports.index') ? 'active' : '' }}">
                <i class="bi bi-bar-chart"></i> Laporan Keuangan
            </a>
        </li>
    </ul>
</div>

<style>
#sidebar {
    position: fixed;
    left: 0;
    width: 275px;
    height: 100vh;
    background: linear-gradient(175deg, #594D9B, #C8CDEA);
    color: white;
    box-shadow: 2px 0 12px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.sidebar-header {
    text-align: center;
    padding: 25px;
    border-bottom: 3px solid rgba(255,255,255,0.2);
}

.sidebar-header h5 {
    margin: 0 0 5px 0;
    font-weight: 500;
    font-size: 1.25rem;
    color: #F3F6FF;
}

.sidebar-header h6{
    margin: 0;
    font-weight: 450;
    font-size: 1rem;
    color: #F3F6FF;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-menu li {
    margin: 5px 0;
}

.sidebar-menu a {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    color: white;
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
}

.sidebar-menu a:hover i {
    margin-right: 25px;
    transform: scale(1.5);
}

.sidebar-menu a.active {
    background-color: #ffffff29;
    border-left: 5px solid #F3F6FF;
    box-shadow: inset 5px 0 10px #ffffff26;
}

.sidebar-menu a.active i {
    transform: scale(1.5);
    transition: transform 0.3s ease;
}
</style>