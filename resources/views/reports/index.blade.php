@extends('layouts.main')

@section('title', 'Laporan Keuangan')

@section('content')
<h1>Laporan Keuangan</h1>
<form action="{{ route('financial-reports.generate') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="type" class="form-label">Jenis Laporan</label>
        <select class="form-select" id="type" name="type" required>
            <option value="balance_sheet">Neraca Saldo</option>
            <option value="income_statement">Laporan Laba Rugi</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="period_start" class="form-label">Periode Mulai</label>
        <input type="date" id="period_start" name="period_start" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="period_end" class="form-label">Periode Akhir</label>
        <input type="date" id="period_end" name="period_end" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Generate Laporan</button>
</form>
@endsection