@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Akun</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('accounts.update', $account->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="code">Kode Akun</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $account->code) }}" required maxlength="10">
            <small class="form-text text-muted">Wajib, unik, maksimal 10 karakter.</small>
        </div>

        <div class="form-group">
            <label for="name">Nama Akun</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $account->name) }}" required>
            <small class="form-text text-muted">Wajib.</small>
        </div>
        <div class="form-group">
            <label for="category_id">Kategori Akun</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" 
                        {{ $account->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- <div class="form-group">
            <label for="type">Tipe Akun</label>
            <select name="type" id="type" class="form-control" required>
                <option value="">Pilih Tipe</option>
                <option value="asset" {{ old('type', $account->type) == 'asset' ? 'selected' : '' }}>Asset</option>
                <option value="liability" {{ old('type', $account->type) == 'liability' ? 'selected' : '' }}>Liability</option>
                <option value="equity" {{ old('type', $account->type) == 'equity' ? 'selected' : '' }}>Equity</option>
                <option value="revenue" {{ old('type', $account->type) == 'revenue' ? 'selected' : '' }}>Revenue</option>
                <option value="expense" {{ old('type', $account->type) == 'expense' ? 'selected' : '' }}>Expense</option>
            </select>
            <small class="form-text text-muted">Wajib, pilih salah satu.</small>
        </div> -->

        <div class="form-group">
            <label for="balance">Saldo Awal</label>
            <input type="number" name="balance" id="balance" class="form-control" value="{{ old('balance', $account->balance) }}" step="0.01">
            <small class="form-text text-muted">Opsional, angka desimal.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Akun</button>
        <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection