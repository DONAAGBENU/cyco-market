<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Création de l'administrateur (update si déjà existant)
        User::updateOrCreate(
            ['email' => 'guedeyiborcyrille3@gmail.com'],
            [
                'name' => 'Admin CYCO',
                'password' => Hash::make('cyrill12345'),
                'role' => 'admin',
                'phone' => '+228 70197698',
                'address' => 'Lome, Togo'
            ]
        );

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