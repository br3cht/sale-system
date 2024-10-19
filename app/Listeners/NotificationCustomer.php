<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Jobs\NotificationSaleForCustomer;
use App\Notifications\OrderPaidNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationCustomer
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPaid $event): void
    {
        NotificationSaleForCustomer::dispatch($event->order,$event->customer);
    }
}
