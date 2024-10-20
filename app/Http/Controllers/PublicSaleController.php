<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetOrdersForCustomer;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class PublicSaleController extends Controller
{
    public function getSaleFromOrder(GetOrdersForCustomer $request)
    {
        $dataRequest = $request->validated();
        //validar se o token e valido
        //

        $order = Order::with('orderItems')->find($dataRequest['order_id']);

        return new OrderResource($order);
    }
}
