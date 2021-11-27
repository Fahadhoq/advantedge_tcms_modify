<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = "expenses";

    protected $fillable = [
        'gl_code_id',
        'amount',
        'remark',
        'expense_date',
        'user_id',
        'money_receipt',
    ];
}
