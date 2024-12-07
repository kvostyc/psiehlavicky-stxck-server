<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderItemState extends Model
{
    protected $fillable = [
        "name",
        "identifier",
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
