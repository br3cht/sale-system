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
        $addMore = true;
        if(!empty(optional($cart)[$productId])){
            $addMore = !$this->notAddMore(
                $cart[$productId]['quantidade'],
                $product->quantidade
            );

            if($addMore) {
                $cart[$productId]['quantidade'] += 1;
            }
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'nome' => $product->nome,
                'preco_venda' => $product->preco_venda,
                'quantidade' => 1,
                'quantidade_disponivel' => $product->quantidade
            ];
        }

        session()->put('cart', $cart);
        if($addMore){
            $this->openModal();
        }
    }

    public function notAddMore(int $quantity, int $maxQuantity): bool
    {
        if(($quantity += 1) > $maxQuantity){
            return true;
        }

        return false;
    }

    public function render()
    {
        $query = Product::query()
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->when($this->searchTerm, function ($query) {
                $query->where('nome', 'like', '%' . $this->searchTerm . '%');
            })->where('quantidade', '>', 0);

        return view('livewire.product-shop', ['products' => $query->paginate(6)]);
    }
}
