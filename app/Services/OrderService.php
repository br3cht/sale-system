<?php

namespace App\Services;

use App\DTO\Order\CreateOrderInput;
use App\Enum\OrderStatusEnum;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

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

        if($input->cupom == 'NTI10'){
            $valorTotal *= 0.60;

            $valorTotal = (int)($valorTotal * 100);
        }

        $order = Order::create([
            'status' => OrderStatusEnum::Pendente->value,
            'customer_id' => $input->customer->id,
            'valor_total' => $valorTotal,
            'token' => Str::random()
        ]);

        $this->createOrderItem($order, $input->cartItems);

        return $order;
    }

    public function createOrderItem(Order $order, array $dataCart): void
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

    public function validationTokenOrder(Order $order, string $token): bool
    {
        if($token == $order->token){
            return true;
        }

        return false;
    }
}
