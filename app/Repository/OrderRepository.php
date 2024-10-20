<?php

namespace App\Repository;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    public function getOrderItems(Order $order): Collection
    {
        return $order->orderItems()->with('product')->get();
    }
}
