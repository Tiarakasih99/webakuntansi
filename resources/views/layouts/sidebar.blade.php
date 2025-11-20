<div class="bg-light border-end" id="sidebar-wrapper" style="min-height: 100vh; width: 250px;">
    <div class="sidebar-heading px-3 py-4 fs-4 fw-bold">Menu</div>
    <div class="list-group list-group-flush">
        <a href="{{ route('accounts.index') }}" class="list-group-item list-group-item-action py-3">Akun Perkiraan</a>
        <a href="{{ route('journals.index') }}" class="list-group-item list-group-item-action py-3">Jurnal Umum</a>
        <a href="{{ route('journals.adjustment') }}" class="list-group-item list-group-item-action py-3">Jurnal Penyesuaian</a>
        <a href="{{ route('ledgers.index') }}" class="list-group-item list-group-item-action py-3">Buku Besar</a>
        <a href="{{ route('trial-balance.index') }}" class="list-group-item list-group-item-action py-3">Neraca Saldo</a>
        <a href="{{ route('financial-reports.index') }}" class="list-group-item list-group-item-action py-3">Laporan Keuangan</a>
    </div>
</div>