<?php

namespace App\Models\Order;

use App\Models\Base\BaseService;
use Illuminate\Database\Eloquent\Model;

class OrderItemStateService extends BaseService
{
    protected ?string $model = OrderItemState::class;

    public function getByIdentifier(string $identifier): ?Model
    {
        return $this->model::whereIdentifier($identifier)->first();
    }
}