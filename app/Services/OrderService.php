<?php

namespace App\Services;

use App\DTO\Order\CreateOrderInput;
use App\Enum\OrderStatusEnum;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repository\OrderRepository;
use Illuminate\Support\Str;

class OrderService
{
    public function __construct(
        protected OrderRepository $orderRepository
    ) {
    }

    public function CreateOrder(CreateOrderInput $input): Order
    {
        $valorTotal = 0;
        foreach($input->cartItems as $item)
        {
            $valor = $item['preco_venda'] * $item['quantidade'];
            $valorTotal += $valor;
        }

        if($input->cupom == 'NTI10'){
            $valorTotal = (int)($valorTotal - ($valorTotal * 0.60));
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

    public function getOrderItems(Order $order)
    {
        return $this->orderRepository->getOrderItems($order);
    }

    public function validationTokenOrder(Order $order, string $token): bool
    {
        if($token == $order->token){
            return true;
        }

        return false;
    }
}
