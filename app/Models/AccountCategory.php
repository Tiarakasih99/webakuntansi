<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'normal_balance'];

    public function accounts()
    {
        return $this->hasMany(Account::class, 'category_id');
    }
}
