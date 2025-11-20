<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function index()
    {
        $accounts = Account::with(['journalEntries.journal'])->orderBy('code')->get();
        return view('ledgers.index', compact('accounts'));
    }
}
