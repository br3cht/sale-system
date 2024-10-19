<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductShop extends Component
{
    use WithPagination;

    public $categories = [];
    public $selectedCategory = null;
    public $searchTerm = null;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }

    public function addToCart(int $productId)
    {
        $product = Product::find($productId);

        $cart = session()->get('cart', []);

        if(!empty(optional($cart)[$productId])){
            $cart[$productId]['quantidade'] += 1;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'nome' => $product->nome,
                'preco_venda' => $product->preco_venda,
                'quantidade' => $product->quantidade,
            ];
        }

        session()->put('cart', $cart);
        session()->flash('message', 'Produto adicionado ao carrinho!');
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->when($this->searchTerm, function ($query) {
                $query->where('nome', 'like', '%' . $this->searchTerm . '%');
            });

        return view('livewire.product-shop', ['products' => $products->paginate(4)]);
    }
}
