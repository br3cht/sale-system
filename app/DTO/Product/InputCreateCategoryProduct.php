<?php

namespace App\DTO\Product;

class InputCreateCategory
{
    public function __construct(
        public readonly string $label,
        public readonly string $slug
    ) { }
}
