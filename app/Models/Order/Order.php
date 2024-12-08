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

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function order_batches()
    {
        return $this->hasMany(OrderBatch::class);
    }
}
