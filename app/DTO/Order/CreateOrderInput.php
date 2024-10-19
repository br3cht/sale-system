<?php

namespace App\DTO\Order;

use App\Models\Customer;

class CreateOrderInput
{
    public function __construct(
        public readonly Customer $customer,
        public readonly array $cartItems
    )
    { }
}
