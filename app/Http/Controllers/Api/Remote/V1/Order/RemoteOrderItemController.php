<?php

namespace App\Http\Controllers\Api\Remote\V1\Order;

use App\Http\Controllers\Api\Base\V1\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Order\OrderItemService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RemoteOrderItemController extends BaseApiController
{
    protected OrderItemService $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
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
        $validIdentifiers = [
            'awaiting_production',
            'in_production',
            'awaiting_review',
            'completed',
        ];

        return $this->handleRequest($request, [
            'order_item_state_identifier' => ['required', 'string', 'max:255', Rule::in($validIdentifiers)],
        ], function ($validatedData) use ($id) {
            $orderItem = $this->orderItemService->get($id);

            if (!$orderItem) {
                return response()->json([
                    'message' => 'OrderItem not found.'
                ], 404);
            }

            $orderItem->update($validatedData);

            return response()->json([
                'message' => 'OrderItem updated successfully.',
                'data' => $orderItem,
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
