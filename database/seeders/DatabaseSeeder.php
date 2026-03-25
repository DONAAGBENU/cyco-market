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
        // Création de l'administrateur principal
        $adminEmail = 'guedeyiborcyrille3@gmail.com';
        
        $admin = User::where('email', $adminEmail)->first();
        
        if (!$admin) {
            User::create([
                'name' => 'Admin CYCO',
                'email' => $adminEmail,
                'password' => Hash::make('cyrill12345'),
                'role' => 'admin',
                'phone' => '+228 70197698',
                'address' => 'Lome, Togo'
            ]);
            $this->command->info("✅ Admin créé avec succès !");
        } else {
            // Mettre à jour l'admin existant
            $admin->update([
                'role' => 'admin',
                'password' => Hash::make('cyrill12345'),
            ]);
            $this->command->info("✅ Admin déjà existant, rôle mis à jour.");
        }

        // Création d'un utilisateur client de test (optionnel)
        if (!User::where('email', 'client@test.com')->exists()) {
            User::create([
                'name' => 'Client Test',
                'email' => 'client@test.com',
                'password' => Hash::make('password123'),
                'role' => 'client',
                'phone' => '+228 90000000',
                'address' => 'Lome, Togo'
            ]);
            $this->command->info("✅ Client de test créé.");
        }

        // Création des catégories par défaut
        $categories = [
            ['name' => 'Électronique', 'description' => 'Produits électroniques et high-tech'],
            ['name' => 'Mode', 'description' => 'Vêtements et accessoires'],
            ['name' => 'Maison', 'description' => 'Meubles et décoration'],
            ['name' => 'Sport', 'description' => 'Équipements sportifs'],
            ['name' => 'Beauté', 'description' => 'Produits de beauté et soins'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
        
        $this->command->info("🎉 Seeders exécutés avec succès !");
    }
}