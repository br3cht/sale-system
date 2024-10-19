<div class="bg-gray-100 min-h-screen">
    @if($isOpen)
        <div  x-transition.opacity class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center">
            <div class="bg-white rounded-lg shadow p-6 w-1/3">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Produto adicionado ao carrinho!</h2>
                <p class="text-gray-600 mb-6">O produto foi adicionado ao seu carrinho com sucesso.</p>
                <div class="flex justify-end">
                    <button wire:click="closeModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors mr-2">
                        Continuar Comprando
                    </button>
                    <a href="{{ route('cart') }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                        Ir para o Carrinho
                    </a>
                </div>
            </div>
        </div>
    @endif
    <div class="shop-container" style="display: flex;">
      <div class="container mx-auto px-4 py-6">
        <div class="flex gap-4">
            <!-- Sidebar de Categorias -->
            <aside class="w-1/4 bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Categorias</h3>
                <ul>
                    @foreach($categories as $category)
                        <li class="mb-2">
                            <a href="#"
                               wire:click.prevent="filterByCategory({{ $category->id }})"
                               class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors {{ $selectedCategory == $category->id ? 'bg-blue-500 text-white' : 'text-gray-700' }}">
                               {{ $category->label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>
               <div class="flex-1">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">Produtos</h3>
                        <input type="text"
                               placeholder="Buscar produtos..."
                               class="border rounded-lg px-4 py-2 w-1/3"
                               wire:model.debounce.300ms="searchTerm">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($products as $product)
                            <div class="bg-white rounded-lg shadow p-4">
                                <h4 class="text-md font-bold text-gray-800">{{ $product->nome }}</h4>
                                <p class="text-gray-600 mt-1">{{ $product->descricao }}</p>
                                <p class="text-blue-500 font-semibold mt-2">R$ {{ $product->preco_venda / 100 }}</p>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="mt-4 rounded-lg w-full h-40 object-cover">
                                @endif
                                <button wire:click="addToCart({{ $product->id }})"
                                        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors w-full">
                                    Adicionar ao Carrinho
                                </button>
                            </div>
                        @empty
                            <p class="text-gray-600">Nenhum produto encontrado para esta categoria.</p>
                        @endforelse
                    </div>

            <div class="mt-6 flex justify-center">
                <nav role="navigation" aria-label="Pagination Navigation" class="flex space-x-1">
                    @if($products->onFirstPage())
                        <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-l-lg cursor-not-allowed">
                            Anterior
                        </span>
                    @else
                        <button wire:click="previousPage" wire:loading.attr="disabled"
                                class="px-4 py-2 bg-blue-500 text-white rounded-l-lg hover:bg-blue-600 transition-colors">
                            Anterior
                        </button>
                    @endif

                    @foreach ($products->links()->elements[0] as $page => $url)
                        @if ($page == $products->currentPage())
                            <span class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                {{ $page }}
                            </span>
                        @else
                            <button wire:click="gotoPage({{ $page }})"
                                    class="px-4 py-2 bg-white text-gray-700 rounded hover:bg-gray-200 transition-colors">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach

                    @if($products->hasMorePages())
                        <button wire:click="nextPage" wire:loading.attr="disabled"
                                class="px-4 py-2 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 transition-colors">
                            Próximo
                        </button>
                    @else
                        <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-r-lg cursor-not-allowed">
                            Próximo
                        </span>
                    @endif
                </nav>
            </div>
        </div>
    </div>
    <a href="{{ route('cart') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
        Ir para o Carrinho
    </a>
</div>
