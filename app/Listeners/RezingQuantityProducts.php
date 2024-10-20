<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Jobs\ReduceQuantityProduct;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RezingQuantityProducts
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected OrderService $orderService,
        protected ProductService $productService
    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPaid $event): void
    {
        $order = $event->order;
        $orderItems = $this->orderService->getOrderItems($order);

        ReduceQuantityProduct::dispatch($this->productService, $orderItems);
    }
}
