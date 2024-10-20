<?php

namespace Tests\Feature;

use App\DTO\Product\InputCreateProduct;
use App\Models\Category;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        User::factory()->create();
    }

    public function test_create_product()
    {
        $service = resolve(ProductService::class);

        Storage::fake('image');
        $file = UploadedFile::fake()->image('image.png');

        $input = new InputCreateProduct(
            name: 'name',
            description: 'description',
            priceBuy: 20000,
            category: Category::find(1),
            priceSell: 20000,
            quantity: 2,
            image: $file,
        );

        $service->createProduct($input);

        $this->assertDatabaseCount('products', 1);
    }
}
