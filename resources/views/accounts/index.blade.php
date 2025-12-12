@extends('layouts.main')

@section('title', 'Akun Perkiraan')

@section('content')
<div class="container-fluid px-4 py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0 title-akun">Akun Perkiraan</h3>
        <a href="{{ route('accounts.create') }}" class="btn btn-primary btn-add-akun">
            + Tambah Akun
        </a>
    </div>

    <div class="card card-table-wrapper">
        <div class="card-body px-0 pt-0">
            <table class="table akun-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Saldo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($accounts as $account)
                    <tr>
                        <td>{{ $account->code }}</td>
                        <td>{{ $account->name }}</td>
                        <td>{{ number_format($account->balance, 2) }}</td>
                        <td>
                            <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('accounts.destroy', $account->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin hapus akun?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Belum ada data akun.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .title-akun {
        color: #1b2737;
        font-weight: 700;
        letter-spacing: .5px;
    }
    
    .btn-add-akun {
        background: linear-gradient(90deg, #594D9B, #8FA3D8);
        border: none;
        border-radius: 12px;
        padding: 9px 18px;
        font-weight: 600;
        color: #fff !important;
        box-shadow: 0 3px 8px rgba(0,0,0,0.18);
        transition: .25s ease;
    }
    
    .btn-add-akun:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.22);
        opacity: .95;
    }
 
    .card-table-wrapper {
        border-radius: 16px;
        overflow: hidden;
        border: none;
        background: #ffffff;
        box-shadow: 0 3px 14px rgba(0,0,0,0.08);
    }
    
    .akun-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    /* HEADER */
    .akun-table thead {
        background: linear-gradient(90deg, #dce1ff, #e7ebff);
    }
    
    .akun-table thead th {
        padding: 16px;
        font-weight: 700;
        color: #3a3f5c;
        text-transform: uppercase;
        font-size: .83rem;
        border-bottom: 2px solid #d6d9f5;
    }
    
    /* BORDER RADIUS ATAS */
    .akun-table thead tr:first-child th:first-child {
        border-top-left-radius: 14px;
    }
    .akun-table thead tr:first-child th:last-child {
        border-top-right-radius: 14px;
    }
    
    /* BODY — WARNA PASTEL */
    .akun-table tbody tr {
        background: #f5f6ff;
        transition: background .2s ease;
    }
    
    .akun-table tbody tr:nth-child(even) {
        background: #eef0ff;
    }
    
    /* CELLS */
    .akun-table tbody tr td {
        padding: 14px 18px;
        color: #2b2b2b;
        border-bottom: 1px solid #e5e6f3;
    }
    
    /* HOVER */
    .akun-table tbody tr:hover {
        background: #e2e5ff !important;
        cursor: pointer;
    }
    
    /* ================================
       BUTTONS ACTION STYLE
    ================================ */
    .btn-warning {
        border-radius: 6px;
        background: linear-gradient(90deg, #5d53a6, #8fa1e0);;
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 4px 10px;
    }
    
    .btn-danger {
        background: linear-gradient(90deg, #5d53a6, #8fa1e0);
        border: none;
        border-radius: 6px;
        font-weight: 600;
        padding: 4px 10px;
    }

    .btn-danger:hover{
        color: #000;
    }
</style>
@endsection