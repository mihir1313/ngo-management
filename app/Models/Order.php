<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'transaction_id',
        'address',
        'subtotal',
        'total',
        'transaction_status',
        'addressArray',
        'created_at',
        
    ];
}
