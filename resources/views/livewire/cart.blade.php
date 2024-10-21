<div class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow py-4">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-bold text-gray-800">Carrinho de Compras</h1>
             <a href="{{route('home')}}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition-colors">
                Voltar
            </a>
        </div>
    </header>

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Produtos no Carrinho</h2>

            @if(empty($cartItems))
                <p class="text-gray-600">Seu carrinho está vazio.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4">Produto</th>
                                <th class="py-2 px-4">Preço</th>
                                <th class="py-2 px-4">Quantidade</th>
                                <th class="py-2 px-4">Subtotal</th>
                                <th class="py-2 px-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $index => $item)
                                <tr>
                                    <td class="py-2 px-4">{{ $item['nome'] }}</td>
                                    <td class="py-2 px-4">R$ {{ number_format(($item['preco_venda'] / 100), 2) }}</td>
                                    <td class="py-2 px-4">
                                        <input type="number" min="1"
                                        :max="{{$item['quantidade_disponivel']}}"
                                        wire:model="cartItems.{{ $index }}.quantidade"
                                        wire:change="updateQuantity({{ $index }}, $event.target.value)"
                                               wire:change="updateQuantity(item,$event.target.value)"
                                               class="border rounded px-2 py-1 w-16" />
                                    </td>
                                    <td class="py-2 px-4">R$ {{ number_format((($item['preco_venda'] * $item['quantidade']) / 100), 2)  }}</td>
                                    <td class="py-2 px-4">
                                        <button wire:click="removeFromCart({{ $loop->index }})"
                                                class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                            Remover
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Total: R$ {{number_format(($total / 100), 2)}}</h3>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-6 mt-6">
            <form wire:submit.prevent="checkout">
                <h2 class="text-xl font-bold mb-4">Cupom de desconto</h2>
                    <div>
                        <label for="cupom" class="block text-sm font-medium text-gray-700">Cupom</label>
                        <input type="text" id="cupom" wire:model="cupom"
                               class="mt-1 block w-full border rounded-lg px-4 py-2">
                        @error('cupom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                <h2 class="text-xl font-bold mb-4">Informações do Cliente</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" id="name" wire:model="name"
                               class="mt-1 block w-full border rounded-lg px-4 py-2">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                        <input type="text" id="cpf" wire:model="cpf"
                               class="mt-1 block w-full border rounded-lg px-4 py-2">
                        @error('cpf') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                        <input type="text" id="phone" wire:model="phone"
                               class="mt-1 block w-full border rounded-lg px-4 py-2">
                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" wire:model="email"
                               class="mt-1 block w-full border rounded-lg px-4 py-2">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                @if(!empty($cartItems))
                    <button type="submit"
                            class="mt-4 bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        Finalizar Compra
                    </button>
                @endif
            </form>
        </div>
    </div>
</div>
