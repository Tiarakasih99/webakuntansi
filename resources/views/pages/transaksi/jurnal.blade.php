@extends('layouts.main')

@section('title', 'Jurnal Umum')

@section('content')
<div class="card shadow-sm mt-0" style="margin-top:-25px;"> 
    <div class="card-body">
        <h4 class="card-title mb-3 text-primary fw-bold">📘 Form Jurnal Umum</h4>
        <p class="text-muted mb-4">
            Gunakan form di bawah untuk mencatat transaksi ke dalam jurnal umum.  
            Pastikan total <strong>Debet</strong> dan <strong>Kredit</strong> seimbang ya 💡
        </p>

        {{-- 🔹 Form Input Jurnal --}}
        <form action="#" method="POST" class="jurnal-form">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="tanggal" class="form-label">Tanggal Transaksi</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>

                <div class="col-md-8">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Contoh: Pembelian perlengkapan kantor" required>
                </div>

                <div class="col-md-6">
                    <label for="akun_debet" class="form-label">Akun Debet</label>
                    <input type="text" name="akun_debet" id="akun_debet" class="form-control" placeholder="Kas / Perlengkapan" required>
                </div>

                <div class="col-md-6">
                    <label for="akun_kredit" class="form-label">Akun Kredit</label>
                    <input type="text" name="akun_kredit" id="akun_kredit" class="form-control" placeholder="Utang / Modal" required>
                </div>

                <div class="col-md-6">
                    <label for="nominal" class="form-label">Nominal (Rp)</label>
                    <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Masukkan jumlah nominal" required>
                </div>

                <div class="col-md-6">
                    <label for="jenis" class="form-label">Jenis Transaksi</label>
                    <select name="jenis" id="jenis" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Debet">Debet</option>
                        <option value="Kredit">Kredit</option>
                    </select>
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">
                    💾 Simpan Transaksi
                </button>
                <button type="reset" class="btn btn-outline-secondary px-4 py-2">
                    🔄 Reset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 15px;
        margin-top: -25px; 
    }

    .card-body {
        padding: 2rem;
    }

    /* Label */
    .form-label {
        font-weight: 600;
        color: #2c3e50;
    }

    /* Input dan select */
    .form-control, .form-select {
        border-radius: 8px;
        transition: 0.2s ease;
        border: 1px solid #dce4ec;
    }

    .form-control:focus, .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    /* Tombol */
    .btn-primary {
        background-color: #3498db;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #2d83c2;
        transform: translateY(-1px);
    }

    .btn-outline-secondary {
        border-radius: 8px;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-outline-secondary:hover {
        background-color: #f0f3f7;
    }

    /* Box form */
    .jurnal-form {
        background-color: #f9fbfc;
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid #eef3f7;
    }
</style>
@endpush
