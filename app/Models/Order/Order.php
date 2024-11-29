<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'customer_email',
        'customer_fullname',
        'total_cost',
        'discount_amout',
        'shipping',
        'note',
        'status',
    ];
}
