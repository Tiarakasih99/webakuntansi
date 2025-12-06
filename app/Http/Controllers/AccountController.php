<?php
namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountCategory; // <-- tambahan
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::orderBy('code')->get();
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        $categories = AccountCategory::all(); // <-- tambahan
        return view('accounts.create', compact('categories')); // <-- tambahan
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:accounts,code|max:10',
            'name' => 'required',
            // 'type' => 'required|in:asset,liability,equity,revenue,expense',
            'balance' => 'nullable|numeric',
            'category_id' => 'required|exists:account_categories,id' // <-- tambahan
        ]);

        Account::create([
            'code' => $request->code,
            'name' => $request->name,
            // 'type' => $request->type,
            'balance' => $request->balance ?? 0,
            'category_id' => $request->category_id, // <-- tambahan
        ]);

        return redirect()->route('accounts.index')
                         ->with('success', 'Akun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $categories = AccountCategory::all(); // <-- tambahan

        return view('accounts.edit', compact('account', 'categories')); // <-- tambahan
    }

    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        $request->validate([
            'code' => 'required|max:10|unique:accounts,code,' . $account->id,
            'name' => 'required',
            // 'type' => 'required|in:asset,liability,equity,revenue,expense',
            'balance' => 'nullable|numeric',
            'category_id' => 'required|exists:account_categories,id' // <-- tambahan
        ]);

        $account->update([
            'code' => $request->code,
            'name' => $request->name,
            // 'type' => $request->type,
            'balance' => $request->balance ?? 0,
            'category_id' => $request->category_id, // <-- tambahan
        ]);

        return redirect()->route('accounts.index')
                         ->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('accounts.index')
                         ->with('success', 'Akun berhasil dihapus.');
    }
}
