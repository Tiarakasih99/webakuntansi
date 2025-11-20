@extends('layouts.main')

@section('title', 'Neraca Saldo')

@section('content')
<h1>Neraca Saldo</h1>
<table class="table table-striped ">
    <thead>
        <tr>
            <th>Akun</th>
            <th>Debit</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $row['account'] }}</td>
            <td>{{ number_format($row['debit'], 2) }}</td>
            <td>{{ number_format($row['credit'], 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection