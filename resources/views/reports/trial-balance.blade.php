@extends('layouts.main')

@section('title', 'Neraca Saldo')

@section('content')
<div class="container p-3">
    <h2 class="mb-4">Neraca Saldo</h2>

    <form method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-striped">
            <tr>
                <th>Kode Akun</th>
                <th>Akun</th>
                <th class="text-end">Debit</th>
                <th class="text-end">Kredit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row['code'] }}</td>
                <td>{{ $row['name'] }}</td>
                <td class="text-end">{{ number_format($row['debit'], 2) }}</td>
                <td class="text-end">{{ number_format($row['credit'], 2) }}</td>
            </tr>
            @endforeach

            <tr class="fw-bold table-secondary">
                <td>Total</td>
                <td></td>
                <td class="text-end">{{ number_format($totalDebit, 2) }}</td>
                <td class="text-end">{{ number_format($totalCredit, 2) }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
