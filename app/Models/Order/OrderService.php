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
    public function createOrderWithItems(array $orderData, array $itemsData)
    {
        $order = Order::create($orderData);

        $itemsGroupedByBatch = collect($itemsData)->groupBy(function ($item) {
            return $item['batch_identifier_code'];
        });

        foreach ($itemsGroupedByBatch as $batchIdentifier => $groupedItems) {
            $batch = OrderBatch::create([
                'order_id' => $order->id,
                'name' => "Batch for " . strtoupper($batchIdentifier),
            ]);

            foreach ($groupedItems as $itemData) {
                $itemData['order_batch_id'] = $batch->id;
                $orderItem = OrderItem::create($itemData);
            }
        }

        return $order;
    }
}
