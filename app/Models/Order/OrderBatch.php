<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderBatch extends Model
{
    protected $fillable = [
        "name",
        "order_id",
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, "order_id");
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
