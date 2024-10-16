<?php

namespace App\Livewire;

use App\DTO\Product\InputCreateProduct;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductCrud extends Component
{
    use WithPagination, WithFileUploads;

    public $name, $description, $price_buy, $price_sell, $product_id, $category_id, $quantity, $image;
    public $isOpen = false;

    public function __construct() {}

    public function render()
    {
        $products = Product::with('category')->paginate(10);
        $categories = Category::all();

        return view('livewire.product-crud', ['products' => $products, 'categories' => $categories]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price_sell = '';
        $this->price_buy = '';
        $this->quantity = '';
        $this->category_id = '';
        $this->image = null;
    }

    public function store()
    {
        $service = resolve(ProductService::class);
        $dataRequest = $this->validate([
            'name' => 'required|string|max:255',
            'price_sell' => 'required|numeric|min:0',
            'price_buy' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $category = Category::find($dataRequest['category_id']);
        $input = new InputCreateProduct(
            name: $dataRequest['name'],
            description: $dataRequest['description'],
            priceBuy: $dataRequest['price_buy'],
            category: $category,
            priceSell: $dataRequest['price_sell'],
            quantity: $dataRequest['quantity'],
            image: $dataRequest['image'],
        );

        $service->createProduct(input: $input);

        session()->flash(
            'message',
            $this->product_id ? 'Product Updated Successfully.' : 'Product Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $service = resolve(ProductService::class);
        $dataRequest = $this->validate([
            'name' => 'nullable|string|max:255',
            'price_sell' => 'nullable|numeric|min:0',
            'price_buy' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $product = Product::findOrFail($id);
        $category = Category::find($dataRequest['category_id']);

        $input = new InputCreateProduct(
            name: optional($dataRequest)['name'],
            description: optional($dataRequest)['description'],
            priceBuy: optional($dataRequest)['price_buy'],
            category: $category ?? null,
            priceSell: optional($dataRequest)['price_sell'],
            quantity: optional($dataRequest)['quantity'],
            image: optional($dataRequest)['image'],
        );

        session()->flash('message', 'Product Updated Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Product Deleted Successfully.');
    }
}
