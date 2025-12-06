@extends('layouts.main')

@section('title', 'Akun Perkiraan')

@section('content')
<h1>Akun Perkiraan</h1>
<a href="{{ route('accounts.create') }}" class="btn btn-primary mb-4">Tambah Akun</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <!-- <th>Tipe</th> -->
            <th>Saldo</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($accounts as $account)
        <tr>
            <td>{{ $account->code }}</td>
            <td>{{ $account->name }}</td>
            <!-- <td>{{ $account->type }}</td> -->
            <td>{{ number_format($account->balance, 2) }}</td>
            <td>
                <a href="{{ route('accounts.edit', $account ->id ) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('accounts.destroy', $account ->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus akun?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">Belum ada data akun.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection