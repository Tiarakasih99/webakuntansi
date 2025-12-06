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
    position: fixed;
    top: 70px;               /* turun sejajar navbar */
    left: 0;
    width: 260px;
    height: calc(100vh - 70px); /* tinggi dikurangi navbar */
    background: linear-gradient(180deg, #476797ff, #084298);
    color: white;
    overflow-y: auto;        /* bisa scroll kalau panjang */
}


.sidebar-header {
    text-align: center;
    padding: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
}

.sidebar-header h4 {
    margin: 0;
    font-weight: bold;
}

.sidebar-header small {
    color: #d1d1d1;
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
    color: white;
    text-decoration: none;
    transition: 0.3s;
    font-weight: 500;
}

.sidebar-menu a:hover {
    background-color: rgba(255,255,255,0.15);
    padding-left: 30px;
    border-left: 4px solid #ffc107;
}

.sidebar-menu i {
    margin-right: 10px;
}
</style>
