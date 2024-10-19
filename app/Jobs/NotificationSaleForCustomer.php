<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Models\Order;
use App\Notifications\OrderPaidNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NotificationSaleForCustomer implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Order $order,
        public Customer $customer
    ) {
        $this->queue = 'notification';
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->customer->notify(new OrderPaidNotification($this->order));
    }
}
