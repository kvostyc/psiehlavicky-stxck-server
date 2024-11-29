<?php

namespace App\Http\Controllers\Api\Remote\V1\Order;

use App\Http\Controllers\Api\Base\V1\BaseApiController;
use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        return $this->handleRequest($request, [
            'order_number' => 'required|string|unique:orders,order_number|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_fullname' => 'required|string|max:255',
            'total_cost' => 'required|numeric|min:0',
            'discount_amout' => 'nullable|numeric|min:0',
            'shipping' => 'required|string|max:255',
            'note' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:pending,processing,completed,canceled',
        ], function ($validatedData) {
            $order = $this->orderService->create($validatedData);

            return response()->json([
                'message' => 'Order created successfully.',
                'order' => $order,
            ], 201);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
