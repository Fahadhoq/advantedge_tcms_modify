<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeGLCode extends Model
{
    use HasFactory;

    protected $table = "income_gl_codes";

    protected $fillable = [
        'name',
    ];
}
