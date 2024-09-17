<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use GuzzleHttp\Client;
use App\Models\Prestataire;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Création des rôles
        $adminRole = Role::create(['name' => 'admin']);
        $clientRole = Role::create(['name' => 'client']);
        $prestataireRole = Role::create(['name' => 'prestataire']);

        // Création d'un admin
        $admin = User::create([
            'nom' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);
        $admin->assignRole($adminRole);
        Admin::create(['user_id' => $admin->id]);

        // Création d'un client
        $client = User::create([
            'nom' => 'Client User',
            'email' => 'client@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
            'status' => 'active',
        ]);
        $client->assignRole($clientRole);
        Client::create(['user_id' => $client->id]);

        // Création d'un prestataire
        $prestataire = User::create([
            'nom' => 'Prestataire User',
            'email' => 'prestataire@example.com',
            'password' => bcrypt('password'),
            'role' => 'prestataire',
            'status' => 'active',
        ]);
        $prestataire->assignRole($prestataireRole);
        Prestataire::create(['user_id' => $prestataire->id]);
    }
}