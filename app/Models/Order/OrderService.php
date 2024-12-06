<?php

namespace App\Models\Order;

use App\Models\Base\BaseService;

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
}
