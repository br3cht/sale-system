<?php

namespace App\DTO\Product;

use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Http\UploadedFile;

class InputCreateProduct
{
    public function __construct(
        public readonly string $name,
        public readonly string  $description,
        public readonly int $priceBuy,
        public readonly int $priceSell,
        public readonly Category $category,
        public readonly int $quantity,
        public readonly UploadedFile $image
    ) { }
}
