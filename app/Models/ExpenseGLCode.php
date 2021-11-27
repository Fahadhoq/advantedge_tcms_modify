<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseGLCode extends Model
{
    use HasFactory;

    protected $table = "expense_gl_codes";

    protected $fillable = [
        'name',
    ];
}
