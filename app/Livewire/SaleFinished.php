<?php

namespace App\Livewire;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SaleFinished extends Component
{
    public string $orderId;
    public Collection $orderItems;
    public int $total;
    public int|null $order = null;
    public string|null $token = null;
    public string|null $status = null;

    protected $queryString = [
        'order',
        'token'
    ];

    public function render()

    {
        $orderService = resolve(OrderService::class);
        $order = Order::find($this->order);

        if(!$orderService->validationTokenOrder(
            order: $order,
            token: $this->token
        )){
            redirect()->route('home');
        }

        $this->orderId = $this->order;
        $this->orderItems = $order->orderItems;
        $this->total = $order->valor_total;
        $this->status = $order->status;

        return view('livewire.sale-finished');
    }
}
