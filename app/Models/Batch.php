<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $table = "batchs";

    protected $fillable = [
        'batch_name',
        'class_id'
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class ,'class_id');
    }
}