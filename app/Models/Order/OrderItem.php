<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        "ean",
        "product_code",
        "dog_breed",
        "with_name",
        "name",
        "price",
        "quantity",
        "size",
        "color",
        "order_item_state_id",
        "order_batch_id",
        "batch_identifier_code",
    ];

    protected $appends = [
        "order_item_state_identifier",
    ];

    public function order_batch()
    {
        return $this->belongsTo(OrderBatch::class, "order_batch_id");
    }

    public function order_item_state()
    {
        return $this->belongsTo(OrderItemState::class, "order_item_state_id");
    }

    protected static function booted()
    {
        static::creating(function (OrderItem $orderItem) {
            if (is_null($orderItem->order_item_state_id)) {
                $defaultState = OrderItemState::where('identifier', 'awaiting_production')?->first();
                $orderItem->order_item_state_id = $defaultState?->id;
            }
        });
    }

    public function getOrderItemStateIdentifierAttribute()
    {
        $state = OrderItemState::find($this->order_item_state_id);
        return $state?->identifier;
    }
}
