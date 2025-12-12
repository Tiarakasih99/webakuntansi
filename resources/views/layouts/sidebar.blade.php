<div id="sidebar">
    <div class="sidebar-header">
        <h4>Akuntansi</h4>
        <small>Menu</small>
    </div>

    <ul class="sidebar-menu">

        <li>
            <a href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('accounts.index') }}">
                <i class="bi bi-wallet2"></i> Akun Perkiraan
            </a>
        </li>
        <li>
            <a href="{{ route('journals.index') }}">
                <i class="bi bi-journal-text"></i> Jurnal Umum
            </a>
        </li>
        <li>
            <a href="{{ route('journals.adjustment') }}">
                <i class="bi bi-clipboard-check"></i> Jurnal Penyesuaian
            </a>
        </li>
        <li>
            <a href="{{ route('ledgers.index') }}">
                <i class="bi bi-book"></i> Buku Besar
            </a>
        </li>
        <li>
            <a href="{{ route('trial.balance') }}">
                <i class="bi bi-calculator"></i> Neraca Saldo
            </a>
        </li>
        <li>
            <a href="{{ route('financial-reports.index') }}">
                <i class="bi bi-bar-chart"></i> Laporan Keuangan
            </a>
        </li>
    </ul>
</div>
<style>
#sidebar {
    background: linear-gradient(180deg, rgba(207,195,241,0.18), rgba(184,197,243,0.18), rgba(164,184,242,0.18)), 
                url('/images/bg-sidebar.jpg');
    background-size: cover;
    background-position: center;
    backdrop-filter: blur(25px);
}

.sidebar-header {
    text-align: center;
    padding: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.35);
}

.sidebar-header h4 {
    margin: 0;
    font-weight: bold;
    color: #1e1e2c;
}

.sidebar-header small {
    color: #3b3b48;
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
    display: block;
    padding: 12px 20px;
    color: #1d1d2d;
    text-decoration: none;
    transition: 0.3s;
    font-weight: 500;
    border-left: 4px solid transparent;
}

.sidebar-menu i {
    margin-right: 10px;
}

.sidebar-menu a:hover {
    background-color: rgba(255, 255, 255, 0.35);
    padding-left: 30px;
    border-left: 4px solid #7b95ff;
    color: #111127;
}
</style>
