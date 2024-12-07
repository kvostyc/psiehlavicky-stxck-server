<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        "order_id",
        "ean",
        "product_code",
        "dog_breed",
        "with_name",
        "name",
        "price",
        "quantity",
        "size",
        "order_item_state_id",
    ];

    protected $appends = [
        "orderItemStateIdentifier",
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, "order_id");
    }

    public function order_item_state()
    {
        return $this->belongsTo(OrderItemState::class, "order_item_state_id");
    }

    protected static function booted()
    {
        static::creating(function (OrderItem $orderItem) {
            if (is_null($orderItem->order_item_state_id)) {
                $defaultState = OrderItemState::where('identifier', 'awaiting_production')->first();
                $orderItem->order_item_state_id = $defaultState?->id;
            }
        });
    }

    public function getOrderItemStateIdentifierAttribute()
    {
        $state = OrderItemState::find($this->order_item_state_id)->first();
        return $state?->identifier;
    }
}
