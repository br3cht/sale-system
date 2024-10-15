<?php

namespace App\DTO\Product;

use App\Models\ProductCategory;
use Illuminate\Http\UploadedFile;

class InputUpdateProduct
{
    public function __construct(
        public readonly string|null $name,
        public readonly string|null  $description,
        public readonly int|null $priceBuy,
        public readonly int|null $priceSell,
        public readonly ProductCategory $category,
        public readonly int|null $quantity,
        public readonly UploadedFile|null $image
    ) { }
}
