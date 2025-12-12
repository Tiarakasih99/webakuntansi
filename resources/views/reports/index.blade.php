@extends('layouts.main')

@section('title', 'Generate Financial Report')

@section('content')

<link rel="stylesheet" href="{{ asset('css/financial-report.css') }}">

<div class="report-wrapper">

    <h3 class="report-title">Laporan Keuangan</h3>

    <form action="{{ route('financial-reports.generate') }}" method="POST" class="report-form">
        @csrf

        <div class="form-group">
            <label>Jenis Laporan</label>
            <select name="category_id" required>
                <option value="balance_sheet">Laporan Posisi Keuangan</option>
                <option value="income_statement">Laporan Laba Rugi</option>
                <option value="changes_in_equity">Laporan Perubahan Modal</option>
            </select>
        </div>

        <div class="form-group">
            <label>Periode Awal</label>
            <input type="date" name="period_start" required>
        </div>

        <div class="form-group">
            <label>Periode Akhir</label>
            <input type="date" name="period_end" required>
        </div>

        <button class="btn-generate">Tampilkan Laporan</button>
    </form>

</div>

<style>
    /* WRAPPER */
    .report-wrapper {
        max-width: 900px;
        margin: auto;
        padding: 30px;
        font-family: "Inter", "Segoe UI", sans-serif;
    }
    
    /* TITLE */
    .report-title {
        font-size: 28px;
        font-weight: 700;
        color: #2b2f42;
        margin-bottom: 25px;
    }
    
    /* FORM CARD */
    .report-form {
        background: #ffffff;
        padding: 25px;
        border-radius: 14px;
        border: 1px solid #e4e4e4;
        box-shadow: 0 3px 12px rgba(0,0,0,0.07);
    }
    
    /* LABEL & INPUT */
    .form-group {
        margin-bottom: 18px;
    }
    
    .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: #3b3f55;
        margin-bottom: 6px;
        display: block;
    }
    
    .report-form input,
    .report-form select {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d6d8e6;
        border-radius: 10px;
        background: #fbfbff;
        transition: .2s ease;
    }
    
    .report-form input:focus,
    .report-form select:focus {
        border-color: #7985d5;
        box-shadow: 0 0 0 3px rgba(125, 140, 220, 0.25);
        background: #fff;
    }
    
    /* BUTTON */
    .btn-generate {
        width: 100%;
        background: linear-gradient(90deg, #5d53a6, #8fa1e0);
        border: none;
        padding: 12px 18px;
        border-radius: 10px;
        color: #fff;
        font-weight: 600;
        box-shadow: 0 3px 10px rgba(0,0,0,0.12);
        transition: 0.25s ease;
    }
    
    .btn-generate:hover {
        transform: translateY(-2px);
        opacity: .95;
    }
</style>
@endsection