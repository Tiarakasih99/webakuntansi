<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'balance',
        'category_id',
    ];

    /**
     * Relasi ke kategori akun
     */
    public function category()
    {
        return $this->belongsTo(AccountCategory::class, 'category_id');
    }

    /**
     * Relasi ke journal entries
     */
    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    /**
     * Relasi ke ledger (opsional, kalau ada tabel ledger)
     */
    public function ledger()
    {
        return $this->hasMany(Ledger::class);
    }

    /**
     * Akses normal balance akun
     */
    // public function getNormalBalanceAttribute()
    // {
    //     // Gunakan nilai dari category
    //     if ($this->category && $this->category->normal_balance) {
    //         return strtolower($this->category->normal_balance);
    //     }

    //     // Default: debit
    //     return 'debit';
    // }

    public function getNormalBalanceAttribute()
    {
        return strtolower($this->category->normal_balance ?? 'debit');
    }

}
