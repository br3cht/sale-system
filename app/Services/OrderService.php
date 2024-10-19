<?php

namespace App\Services;

use App\DTO\Order\CreateOrderInput;
use App\Enum\OrderStatusEnum;
use App\Models\Order;
use App\Models\OrderItem;

class OrderService
{
    public function CreateOrder(CreateOrderInput $input): Order
    {
        $valorTotal = 0;
        foreach($input->cartItems as $item)
        {
            $valor = $item['preco_venda'] * $item['quantidade'];
            $valorTotal += $valor;
        }

        $order = Order::create([
            'status' => OrderStatusEnum::Pendente,
            'customer_id' => $input->customer->id,
            'valor_total' => $valorTotal
        ]);

        $this->createOrderItem($order, $input->cartItems);

        return $order;
    }

    public function createOrderItem(Order $order, array $dataCart)
    {
        $keys = array_keys($dataCart);

        foreach($keys as $key) {
            $dataCart[$key];

            OrderItem::create([
                'product_id' => $key,
                'order_id' => $order->id,
                'quantidade' => $dataCart[$key]['quantidade'] ,
                'preco' => $dataCart[$key]['preco_venda']
            ]);
        }
    }
}
