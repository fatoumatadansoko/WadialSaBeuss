<?php
namespace Database\Seeders;

// database/seeders/UsersTableSeeder.php
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        // Créer un seul utilisateur admin
        User::create([
            'nom' => 'Admin User', // Nom de l'utilisateur
            'email' => 'fatoumatadansoko61.com', // Email unique
            'password' => bcrypt('password'), // Mot de passe
            'telephone' => '0123456789', // Numéro de téléphone
            'adresse' => '123 Admin St, Admin City', // Adresse
            'status' => 'active', // Statut
            'description' => 'Description de l\'administrateur', // Description
            'role' => 'admin', // Rôle de l'utilisateur
            'remember_token' => null, // Vous pouvez laisser ceci vide ou générer un token
            'logo' => 'logo.png', //
        ]);
    }
}
