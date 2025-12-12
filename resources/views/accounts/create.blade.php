@extends('layouts.main')

@section('content')
<div class="container-fluid px-4 py-3">

    <h3 class="fw-bold mb-4 title-akun">Tambah Akun Baru</h3>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm" style="border-radius:10px;">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card form-card shadow-sm">
        <div class="card-body">

            <form action="{{ route('accounts.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="code" class="form-label fw-semibold">Kode Akun</label>
                    <input type="text" name="code" id="code" class="form-control input-soft"
                           value="{{ old('code') }}" required maxlength="10">
                    <div class="form-text">Wajib, unik, maksimal 10 karakter.</div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Akun</label>
                    <input type="text" name="name" id="name" class="form-control input-soft"
                           value="{{ old('name') }}" required>
                    <div class="form-text">Wajib.</div>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label fw-semibold">Kategori Akun</label>
                    <select name="category_id" id="category_id" class="form-select input-soft" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="balance" class="form-label fw-semibold">Saldo Awal</label>
                    <input type="number" step="0.01" name="balance" id="balance"
                           class="form-control input-soft" value="{{ old('balance') }}">
                    <div class="form-text">Opsional, angka desimal.</div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-add-akun">
                        Simpan Akun
                    </button>
                    <a href="{{ route('accounts.index') }}" class="btn btn-secondary btn-kembali">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

<style>
    /* CARD */
    .form-card {
        border-radius: 16px;
        padding: 6px 4px;
        background: #ffffff;
        box-shadow: 0 3px 15px rgba(0,0,0,0.07);
        border: none;
    }
    
    /* INPUT STYLE */
    .input-soft {
        border-radius: 12px !important;
        border: 1px solid #d8dcee;
        padding: 10px 14px;
        transition: .2s ease;
        background: #fbfbff;
    }
    
    .input-soft:focus {
        border-color: #7a86d6;
        box-shadow: 0 0 0 3px rgba(125, 140, 220, 0.25);
        background: #ffffff;
    }
    
    /* LABEL */
    .form-label {
        color: #333;
    }
    
    /* BUTTON TAMBAH */
    .btn-add-akun {
        background: linear-gradient(90deg, #5d53a6, #8fa1e0);
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        color: white !important;
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        transition: .25s ease;
    }
    
    .btn-add-akun:hover {
        transform: translateY(-2px);
        opacity: .95;
        box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    }
    
    /* BUTTON KEMBALI */
    .btn-kembali {
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
    }
    
    /* TITLE */
    .title-akun {
        color: #1b2737;
    }
</style>
@endsection