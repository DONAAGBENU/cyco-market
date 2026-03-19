<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Création de l'administrateur via le seeder dédié
        $this->call(AdminUserSeeder::class);

        // Création de catégories par défaut
        $categories = [
            ['name' => 'Électronique', 'description' => 'Produits électroniques et high-tech'],
            ['name' => 'Mode', 'description' => 'Vêtements et accessoires'],
            ['name' => 'Maison', 'description' => 'Meubles et décoration'],
            ['name' => 'Sport', 'description' => 'Équipements sportifs'],
            ['name' => 'Beauté', 'description' => 'Produits de beauté et soins'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}