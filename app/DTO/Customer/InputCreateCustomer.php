<?php

namespace App\DTO\Customer;

class InputCreateCustomer
{
    public function __construct(
        public readonly string $name,
        public readonly string $cpf,
        public readonly string $email,
        public readonly string $phone
    )
    { }
}
