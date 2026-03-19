<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Crée ou met à jour l'utilisateur administrateur.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'guedeyiborcyrille3@gmail.com'],
            [
                'name'     => 'Admin CYCO',
                'password' => Hash::make('cyrill12345'),
                'role'     => 'admin',
                'phone'    => '+228 70197698',
                'address'  => 'Lome, Togo',
            ]
        );
    }
}
