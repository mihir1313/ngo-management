<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    protected $table = 'donations';

    protected $fillable = [
        'id',
        'cause_id',
        'transaction_id',
        'total',
        'transaction_status',
        'created_at', 
        'updated_at',
    ];
}
