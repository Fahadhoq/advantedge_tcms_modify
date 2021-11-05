<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyExpense extends Model
{
    use HasFactory;

    protected $table = "daily_expenses";

    protected $fillable = [
        'expense_type',
        'expense_amount',
        'expense_remark',
        'expense_date',
    ];
}
