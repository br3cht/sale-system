<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'label' => 'Eletrônicos',
                'slug' => 'eletronicos',
            ],
            [
                'label' => 'Moda',
                'slug' => 'moda',
            ],
            [
                'label' => 'Casa e Cozinha',
                'slug' => 'casa-e-cozinha',
            ],
            [
                'label' => 'Beleza e Cuidados Pessoais',
                'slug' => 'beleza-e-cuidados-pessoais',
            ],
            [
                'label' => 'Esportes e Lazer',
                'slug' => 'esportes-e-lazer',
            ],
            [
                'label' => 'Brinquedos e Jogos',
                'slug' => 'brinquedos-e-jogos',
            ],
            [
                'label' => 'Ferramentas e Construção',
                'slug' => 'ferramentas-e-construcao',
            ],
            [
                'label' => 'Alimentos e Bebidas',
                'slug' => 'alimentos-e-bebidas',
            ],
            [
                'label' => 'Livros',
                'slug' => 'livros',
            ],
            [
                'label' => 'Informática',
                'slug' => 'informatica',
            ],
        ];

        if(Category::count() == 0){
            Category::upsert($categories,['id']);
        }
    }
}
