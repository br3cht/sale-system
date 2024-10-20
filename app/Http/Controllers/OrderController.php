<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    ) { }

    public function getStatus(OrderStatusRequest $request, Order $order)
    {
        $dataRequest = $request->validated();

        if(!$this->orderService->validationTokenOrder(
            order: $order,
            token: $dataRequest['token']
        )){
            abort(401);
        }

        $order = $order->with('orderItems');

        return new OrderResource($order);
    }
}
