@extends('layouts.main')

@section('content')
<div class="container mt-4">

    <form action="{{ route('financial-reports.generate') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Jenis Laporan</label>
            <select name="category_id" class="form-control" required>
                <option value="balance_sheet">Laporan Posisi Keuangan</option>
                <option value="income_statement">Laporan Laba Rugi</option>
                <option value="changes_in_equity">Laporan Perubahan Modal</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Periode Awal</label>
            <input type="date" name="period_start" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Periode Akhir</label>
            <input type="date" name="period_end" class="form-control" required>
        </div>

        <button class="btn btn-primary">Tampilkan Laporan</button>
    </form>

</div>
@endsection
