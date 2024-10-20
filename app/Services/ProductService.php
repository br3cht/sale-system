<?php

namespace App\Services;

use App\DTO\Product\InputCreateProduct;
use App\DTO\Product\InputUpdateProduct;
use App\Models\Product;
use App\Repository\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected FileService $fileService
    ) { }

    public function createProduct(InputCreateProduct $input): void
    {
        $path = null;
        $data = [
            'nome' => $input->name,
            'descricao' => $input->description,
            'preco_venda' => $input->priceSell,
            'preco_compra' => $input->priceBuy,
            'quantidade' => $input->quantity,
            'category_id' => $input->category->id,
            'image' => null,
        ];

        DB::transaction(function () use ($data, $input, $path){
            try {
                $path = $this->fileService->storeFile(
                    folder:'/product-image',
                    file: $input->image
                );

                $data['image'] = $path;
                $this->productRepository->create($data);
            } catch (Exception $exception) {
                if ($path && Storage::has($path)) {
                    Storage::delete($path);
                }

                throw $exception;
            }
        });
    }

    public function updateProduct(Product $product, InputUpdateProduct $input)
    {
        $path = null;
        $dataForUpdate = [
            'nome' => $input->name ?? $product->nome,
            'descricao' => $input->description ?? $product->descricao,
            'preco_venda' => $input->priceSell ?? $product->preco_venda,
            'preco_compra' => $input->priceBuy ?? $product->preco_compra,
            'quantidade' => $input->quantity ?? $product->quantidade,
            'category_id' => $input->category->id,
            'image' => $product->image,
        ];

        DB::transaction(function () use ($dataForUpdate, $input, $path, $product){
            try {
                if(!empty($input->image)){
                    $path = $this->fileService->storeFile(
                        folder:'/product-image',
                        file: $input->image
                    );

                    $dataForUpdate['image'] = $path;
                }

                $this->productRepository->update(
                    product: $product,
                    data: $dataForUpdate
                );
            } catch (Exception $exception) {
                if ($path && Storage::has($path)) {
                    Storage::delete($path);
                }

                throw $exception;
            }
        });
    }

    public function deleteProduct(Product $product)
    {
        $path = $product->image;

        if(Storage::has($path)){
            Storage::delete($path);
        }

        $product->delete();
    }

    public function reduceQuatity(Product $product, int $quantity)
    {
        $product->update(['quantidade' => $product->quantidade - $quantity]);
    }
}
