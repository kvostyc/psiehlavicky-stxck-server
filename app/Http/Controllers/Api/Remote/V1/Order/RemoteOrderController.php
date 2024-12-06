<?php

namespace App\Http\Controllers\Api\Remote\V1\Order;

use App\Http\Controllers\Api\Base\V1\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order\OrderService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RemoteOrderController extends BaseApiController
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $status = $request->input('status');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $query = $this->orderService->query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $orders = $query->paginate($perPage);

        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateOrderRequest $request)
    {
        return $this->handleRequest($request, $request->rules(), function ($validatedData) {
            $order = $this->orderService->create($validatedData);

            return response()->json([
                'message' => 'Order created successfully.',
                'data' => $order,
            ], 201);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $orderNumber)
    {
        $order = $this->orderService->getByOrderNumber($orderNumber);

        if (!$order) {
            return response()->json([
                'message' => 'Order not found.'
            ], 404);
        }

        return response()->json([
            "message" => "Order found successfully.",
            "data" => $order
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $orderNumber)
    {
        return $this->handleRequest($request, [
            "status" => "string"
        ], function ($validatedData) use ($orderNumber) {
            $order = $this->orderService->getByOrderNumber($orderNumber);

            if (!$order) {
                return response()->json([
                    'message' => 'Order not found.'
                ], 404);
            }

            $order->update($validatedData);

            return response()->json([
                'message' => 'Order updated successfully.',
                'data' => $order,
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
