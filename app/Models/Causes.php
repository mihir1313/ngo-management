<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Causes extends Model
{
    protected $table = 'causes';

    protected $fillable = [
        'title',
        'img',
        'target',
        'description',
        'created_at', 
        'updated_at',
    ];
}
