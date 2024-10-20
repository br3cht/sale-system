<?php

namespace App\Services;

use App\DTO\Customer\InputCreateCustomer;
use App\Models\Customer;

class CustomerService
{
    public function createCustomer(InputCreateCustomer $input): Customer
    {
        return Customer::create([
            'nome' => $input->name,
            'email' => $input->email,
            'cpf' => $input->cpf,
            'telefone' => $input->phone
        ]);
    }
}
