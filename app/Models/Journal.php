<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_number', 'date', 'description', 'total', 'user_id'];

    public function entries()
    {
        return $this->hasMany(JournalEntry::class);
    }
}