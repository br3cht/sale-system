<?php

namespace App\Livewire;

use App\Http\Resources\ProductResource;
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
    public $isOpen = false;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
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
                'quantidade' => 1,
            ];
        }

        session()->put('cart', $cart);
        $this->openModal();

        session()->flash('message', 'Produto adicionado ao carrinho!');
    }

    public function render()
    {
        $query = Product::query()
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->when($this->searchTerm, function ($query) {
                $query->where('nome', 'like', '%' . $this->searchTerm . '%');
            });

        return view('livewire.product-shop', ['products' => $query->paginate(6)]);
    }
}
