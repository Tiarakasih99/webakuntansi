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

@push('styles')
<style>
    /* 🔹 Sidebar Container */
    .sidebar {
        background-color: #f8fafc;
        min-height: 100vh;
        border-right: 1px solid #e5e9f0;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        padding-top: 1.5rem;
        transition: all 0.3s ease;
    }

    /* 🔹 Judul Sidebar */
    .sidebar h4 {
        color: #2c3e50;
        text-align: center;
        letter-spacing: 0.5px;
    }

    /* 🔹 Navigasi Utama */
    .sidebar .nav-item {
        margin-bottom: 1rem;
    }

    .sidebar .fw-semibold {
        font-size: 0.9rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 0.3rem;
    }

    /* 🔹 Submenu Links */
    .sidebar .submenu li {
        margin: 6px 0;
    }

    .sidebar .submenu a {
        display: block;
        text-decoration: none;
        color: #34495e;
        font-weight: 500;
        padding: 6px 10px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .sidebar .submenu a:hover {
        background-color: #3498db;
        color: #fff;
        padding-left: 14px;
    }

    /* 🔹 Active State (opsional kalau mau kasih class active) */
    .sidebar .submenu a.active {
        background-color: #2980b9;
        color: white;
        font-weight: 600;
    }

    /* 🔹 Responsive untuk layar kecil */
    @media (max-width: 992px) {
        .sidebar {
            position: relative;
            width: 100%;
            min-height: auto;
            border-right: none;
            border-bottom: 1px solid #e5e9f0;
        }

        .sidebar h4 {
            text-align: left;
            padding-left: 1rem;
        }
    }
</style>
@endpush
