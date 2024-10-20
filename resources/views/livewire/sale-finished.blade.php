<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-lg w-full p-6 bg-white rounded-lg shadow-md ">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">Obrigado pela sua compra!</h1>
        <p class="text-center text-gray-600 mb-6">
            Seu pedido <strong class="text-gray-800">#{{ $orderId }}</strong> foi processado com sucesso.
        </p>

        <p class="text-center text-gray-600 mb-6">
            Status <strong class="text-gray-800">{{$status}}</strong>
        </p>

        <h2 class="text-xl font-semibold text-gray-800 mb-2">Resumo do Pedido</h2>
        <ul class="list-disc list-inside space-y-2">
            @foreach ($orderItems as $item)
                <li class="text-gray-700">
                    <span class="font-medium">{{ $item->product->nome }}</span> - Quantidade: {{ $item->quantidade }} - R$ {{ number_format(($item->preco / 100), 2) }}
                </li>
            @endforeach
        </ul>

        <p class="mt-4 text-lg font-bold text-gray-800">
            <strong>Total: R$ {{ number_format(($total / 100), 2, ',', '.') }}</strong>
        </p>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}"
               class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition-colors">
                Página inicial
            </a>
        </div>
    </div>
</div>
