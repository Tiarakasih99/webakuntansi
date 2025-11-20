<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    // Tampilkan daftar akun
    public function index()
    {
        $accounts = Account::orderBy('code')->get();
        return view('accounts.index', compact('accounts'));
    }

    // Tampilkan form buat akun baru
    public function create()
    {
        return view('accounts.create');
    }

    // Simpan data akun baru
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:accounts,code|max:10',
            'name' => 'required|string',
            'type' => 'required|in:asset,liability,equity,revenue,expense',
            'balance' => 'nullable|numeric',
        ]);

        Account::create($request->all());

        return redirect()->route('accounts.index')->with('success', 'Akun berhasil dibuat.');
    }

    // Tampilkan form edit akun
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    // Update akun
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'code' => 'required|max:10|unique:accounts,code,' . $account->id,
            'name' => 'required|string',
            'type' => 'required|in:asset,liability,equity,revenue,expense',
            'balance' => 'nullable|numeric',
        ]);

        $account->update($request->all());

        return redirect()->route('accounts.index')->with('success', 'Akun berhasil diperbarui.');
    }

    // Hapus akun
    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('accounts.index')->with('success', 'Akun berhasil dihapus.');
    }
}
