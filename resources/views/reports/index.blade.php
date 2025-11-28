@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Generate Laporan Keuangan</h1>
    <form action="{{ route('reports.generate') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Tipe Laporan</label>
            <select name="type" class="form-control" required>
                <option value="balance_sheet">Posisi Keuangan (Balance Sheet)</option>
                <option value="income_statement">Laba Rugi (Income Statement)</option>
                <option value="changes_in_equity">Perubahan Modal (Changes in Equity)</option>
            </select>
        </div>
        <div class="form-group">
            <label>Periode Mulai</label>
            <input type="date" name="period_start" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Periode Akhir</label>
            <input type="date" name="period_end" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate</button>
    </form>
</div>

<style>
    .container{
        padding : 10px
    }
    
</style>
@endsection

