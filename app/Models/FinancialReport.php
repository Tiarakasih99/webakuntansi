<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'period_start', 'period_end', 'data', 'total_assets', 'total_liabilities', 'total_equity', 'net_income', 'user_id'];

    protected $casts = ['data' => 'array']; // Untuk JSON
}