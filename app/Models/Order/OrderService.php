<?php

namespace App\Models\Order;

use App\Models\Base\BaseService;
use Illuminate\Support\Facades\DB;

class OrderService extends BaseService
{
    protected ?string $model = Order::class;

    /**
     * Get an order by its order number.
     */
    public function getByOrderNumber(string $orderNumber)
    {
        return $this->model::where('order_number', $orderNumber)->first();
    }

    /**
     * Create a new order with its items.
     */
    public function createOrderWithItems(array $orderData, array $items): Order
    {
        return DB::transaction(function () use ($orderData, $items) {
            $order = $this->model::create($orderData);

            foreach ($items as $item) {
                $order->order_items()->create($item);
            }

            return $order->load('order_items');
        });
    }
}
