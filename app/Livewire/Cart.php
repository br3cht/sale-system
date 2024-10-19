<?php

namespace App\Livewire;

use App\DTO\Customer\InputCreateCustomer;
use App\DTO\Order\CreateOrderInput;
use App\Enum\OrderStatusEnum;
use App\Events\OrderPaid;
use App\Services\CustomerService;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];
    public $name;
    public $cpf;
    public $phone;
    public $email;
    public $cupom;
    public $total = 0;

    protected $rules = [
        'cupom' => 'nullable|string',
        'name' => 'required|string',
        'cpf' => 'required|string',
        'phone' => 'required|string',
        'email' => 'required|email',
    ];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = session()->get('cart', []);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        if (!empty($this->cartItems)) {
            $this->total = collect($this->cartItems)->sum(function ($item) {
                return $item['preco_venda'] * $item['quantidade'];
            });
        }
    }

    public function updateQuantity(int $index, int $quantity)
    {
        $this->cartItems[$index]['quantidade'] = $quantity;

        session()->put('cart', $this->cartItems);

        $this->calculateTotal();
    }

    public function removeFromCart($index)
    {
        array_splice($this->cartItems, $index, 1);
        session()->put('cart', $this->cartItems);
        $this->calculateTotal();
    }

    public function checkout()
    {
        $this->validate();
        $orderService = resolve(OrderService::class);
        $customerService = resolve(CustomerService::class);
        $inputCustomer = new InputCreateCustomer(
            name: $this->name,
            email: $this->email,
            cpf: $this->cpf,
            phone: $this->phone
        );

        $data = DB::transaction(function () use ($orderService, $customerService, $inputCustomer){

            $customer = $customerService->createCustomer($inputCustomer);

            $input = new CreateOrderInput(
                customer: $customer,
                cartItems: $this->cartItems
            );

            $order = $orderService->CreateOrder($input);

            $order->update(['status' => OrderStatusEnum::Pago->value]);

            Log::info('Pedido Pago:' . $order->id);

            return ['customer' => $customer, 'order' => $order];
        });

        event(new OrderPaid($data['customer'], $data['order']));

        session()->flash('message', 'Compra finalizada com sucesso!');
        session()->forget('cart');
        $this->cartItems = [];
        $this->calculateTotal();
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
