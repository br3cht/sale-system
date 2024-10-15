<div class="container max-auto">
    <button wire:click="create()" class="
    font-bold
    text-white
    rounded-md
    bg-blue-800"
    >
        Criar Produto
    </button>

    @if($isOpen)
        @include('livewire.product-create')
    @endif

    @if(!empty($products))
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descricao</th>
                    <th>Categoria</th>
                    <th>Preço Venda</th>
                    <th>Preço Compra</th>
                    <th>Quantidade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->nome }}</td>
                        <td>{{ $product->descricao }}</td>
                        <td>{{ $product->category_id }}</td>
                        <td>{{ $product->preco_venda }}</td>
                        <td>{{ $product->preco_compra }}</td>
                        <td>{{ $product->quantidade }}</td>
                        <td>
                            <button wire:click="edit({{ $product->id }})" class="bg-yellow-500 text-white px-4 py-2">Edit</button>
                            <button wire:click="delete({{ $product->id }})" class="bg-red-500 text-white px-4 py-2">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Links de paginação -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
