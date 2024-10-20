<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Models\Order;
use App\Notifications\OrderPaidNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

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
        Log::debug('Enviando Notificacao para o cliente: ' . $this->customer->nome);
        $this->customer->notify(new OrderPaidNotification($this->order));
    }
}
