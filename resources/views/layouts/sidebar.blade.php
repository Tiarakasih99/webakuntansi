<div class="sidebar p-3">
    <h4 class="fw-bold border-bottom pb-2 mb-3">Web Akuntansi</h4>

    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <span class="fw-semibold text-secondary">Transaksi</span>
            <ul class="list-unstyled submenu">
                <li><a href="{{ route('jurnal.index') }}">• Jurnal Umum</a></li>
                <li><a href="{{ route('buku_besar.index') }}">• Buku Besar</a></li>
                <li><a href="{{ route('neraca_saldo.index') }}">• Neraca Saldo</a></li>
                <li><a href="{{ route('neraca_ses.index') }}">• Neraca Setelah Penyesuaian</a></li>
            </ul>
        </li>

        <li class="nav-item mt-3">
            <span class="fw-semibold text-secondary">Laporan Keuangan</span>
            <ul class="list-unstyled submenu">
                <li><a href="{{ route('laba_rugi.index') }}">• Laba Rugi</a></li>
                <li><a href="{{ route('posisi_keuangan.index') }}">• Posisi Keuangan</a></li>
                <li><a href="{{ route('perubahan_modal.index') }}">• Perubahan Modal</a></li>
            </ul>
        </li>
    </ul>
</div>
