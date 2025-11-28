<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'type', 'balance'];

    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    public function ledger()
    {
        return $this->hasMany(Ledger::class);
    }
}