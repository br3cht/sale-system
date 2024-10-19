<?php

namespace App\Services;

use App\DTO\Order\CreateOrderInput;
use App\Models\Order;

class OrderServices
{
    public function CreateOrder(CreateOrderInput $input)
    {
        $valorTotal = 0;
        foreach($input->cartItems as $item)
        {
            $valor = $item['preco_venda'] * $item['quantidade'];

            $valorTotal += $valor;
        }

        Order::create([
            'customer_id' => $input->customer->id,
            'valor_total' => $valorTotal
        ]);
    }

    public function createOrderItem()
    {
    }
}
