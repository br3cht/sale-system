<?php

namespace App\Services\Product;

use App\DTO\Product\InputCreateCategory;
use App\DTO\Product\InputeUpdateCategory;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class CategoryProductService
{
    public function createCategory(InputCreateCategory $input)
    {
        $data = [
            'label' => $input->label,
            'slug' => Str::slug($input->slug, '_')
        ];

        Category::create($data);
    }

    public function updateCategory(
        Category $productCategory,
        InputeUpdateCategory $input
    ) {
        $data = [
            'label' => $input->label ?? $productCategory->label,
            'slug' => Str::slug($input->slug, '_') ?? $productCategory->slug
        ];

        $productCategory->update($data);
    }
}
