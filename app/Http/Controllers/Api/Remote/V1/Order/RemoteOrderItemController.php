<?php

namespace App\Http\Controllers\Api\Remote\V1\Order;

use App\Http\Controllers\Api\Base\V1\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Order\OrderItemService;
use App\Models\Order\OrderItemStateService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RemoteOrderItemController extends BaseApiController
{
    protected OrderItemService $orderItemService;

    protected OrderItemStateService $orderItemStateService;

    public function __construct(OrderItemService $orderItemService, OrderItemStateService $orderItemStateService)
    {
        $this->orderItemService = $orderItemService;
        $this->orderItemStateService = $orderItemStateService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orderItem = $this->orderItemService->get($id);

        if (!$orderItem) {
            return response()->json([
                'message' => 'OrderItem not found.'
            ], 404);
        }

        return response()->json([
            "message" => "OrderItem found successfully.",
            "data" => $orderItem
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->handleRequest($request, [
            'order_item_state_identifier' => ['required', 'string', 'max:255'],
        ], function ($validatedData) use ($id) {
            $orderItem = $this->orderItemService->get($id);

            if (!$orderItem) {
                return response()->json([
                    'message' => 'OrderItem not found.'
                ], 404);
            }

            $state = $this->orderItemStateService->getByIdentifier($validatedData['order_item_state_identifier']);

            if (!$state) {
                return response()->json([
                    'message' => 'Invalid order item state identifier.'
                ], 400);
            }

            $orderItem->update([
                'order_item_state_id' => $state->id,
            ]);

            return response()->json([
                'message' => 'OrderItem updated successfully.',
                'data' => $orderItem,
                'state' => $state,
            ], 200);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
