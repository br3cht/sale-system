<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'eletronicos' => [
                [
                    'nome' => 'Smartphone XYZ',
                    'preco_venda' => 199999,
                    'preco_compra' => 150000,
                    'descricao' => 'Smartphone com tela de 6.5", 128GB de armazenamento, e câmera tripla de 48MP.',
                    'image' => $this->getPathForImageWebp('smartphone'),
                    'category_id' => null,
                    'quantidade' => fake()->randomNumber()
                ],
                [
                    'nome' => 'Smart TV 50" 4K',
                    'preco_venda' => 299999,
                    'preco_compra' => 250000,
                    'descricao' => 'Smart TV com resolução 4K e tecnologia HDR, ideal para assistir a seus filmes favoritos.',
                    'image' => $this->getPathForImageWebp('tv'),
                    'category_id' => null,
                    'quantidade' => fake()->randomNumber()
                ],
                [
                    'nome' => 'Notebook Ultra Thin',
                    'preco_venda' => 399999,
                    'preco_compra' => 320000,
                    'descricao' => 'Notebook leve e fino com processador Intel i7 e 16GB de RAM, ideal para produtividade.',
                    'image' => $this->getPathForImageWebp('laptop'),
                    'category_id' => null,
                    'quantidade' => fake()->randomNumber()
                ],
            ],
            'moda' => [
                [
                    'nome' => 'Camiseta Básica',
                    'preco_venda' => 4999,
                    'preco_compra' => 2500,
                    'descricao' => 'Camiseta de algodão, confortável e ideal para o dia a dia.',
                    'image' => $this->getPathForImageWebp('camisa_basica'),
                    'category_id' => null,
                    'quantidade' => fake()->randomNumber()
                ],
                [
                    'nome' => 'Jaqueta Jeans',
                    'preco_venda' => 19999,
                    'preco_compra' => 12000,
                    'descricao' => 'Jaqueta jeans clássica, perfeita para compor diversos looks.',
                    'image' => $this->getPathForImageWebp('jaqueta'),
                    'category_id' => null,
                    'quantidade' => fake()->randomNumber()
                ],
                [
                    'nome' => 'Tênis Esportivo',
                    'preco_venda' => 29999,
                    'preco_compra' => 18000,
                    'descricao' => 'Tênis confortável e resistente, ideal para prática de esportes.',
                    'image' => $this->getPathForImageWebp('tenis'),
                    'category_id' => null,
                    'quantidade' => fake()->randomNumber()
                ],
            ],
            'casa-e-cozinha' => [
                [
                    'nome' => 'Liquidificador 500W',
                    'preco_venda' => 14999,
                    'preco_compra' => 10000,
                    'descricao' => 'Liquidificador potente com 5 velocidades, ideal para preparar sucos e vitaminas.',
                    'image' => $this->getPathForImageWebp('liquidificador'),
                    'quantidade' => fake()->randomNumber(),
                    'category_id' => null,
                ],
                [
                    'nome' => 'Jogo de Panelas Antiaderentes',
                    'preco_venda' => 29999,
                    'preco_compra' => 20000,
                    'descricao' => 'Conjunto de panelas antiaderentes com 5 peças, fácil de limpar e resistente.',
                    'image' => $this->getPathForImageWebp('panela_antiaderente'),
                    'quantidade' => fake()->randomNumber(),
                    'category_id' => null,
                ],
                [
                    'nome' => 'Cafeteira Elétrica',
                    'preco_venda' => 19999,
                    'preco_compra' => 14000,
                    'descricao' => 'Cafeteira elétrica com capacidade para 12 xícaras, para café fresco a qualquer hora.',
                    'image' => $this->getPathForImageWebp('cafeteira'),
                    'quantidade' => fake()->randomNumber(),
                    'category_id' => null,
                ],
            ],
        ];

        if (Product::count() == 0) {
            $keys = array_keys($products);

            foreach($keys as $key) {
                $category = Category::where('slug', $key)->first();

                if(!empty($category)){
                    foreach($products[$key] as &$product) {
                        $product['category_id'] = $category->id;
                    }

                    Product::upsert($products[$key], ['id']);
                }
            }
        }
    }

    public function getPathForImageWebp(string $filename)
    {
        return 'images/' . $filename . '.webp';
    }
}
