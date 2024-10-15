<?php

namespace App\DTO\Product;

class InputeUpdateCategory
{
    public function __construct(
        public readonly string|null $label,
        public readonly string|null $slug,
    ) { }
}
