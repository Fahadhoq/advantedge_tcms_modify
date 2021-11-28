<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = "incomes";

    protected $fillable = [
        'gl_code_id',
        'amount',
        'remark',
        'income_date',
        'receiver_id',
        'money_receipt',
    ];
}
