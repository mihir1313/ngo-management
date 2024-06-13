<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model

{
    protected $table = 'volunteer';

    protected $fillable = [
        'name',
        'img',
        'status',
        'created_at', 
    ];

   
}
