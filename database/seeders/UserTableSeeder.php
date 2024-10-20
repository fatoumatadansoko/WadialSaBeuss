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

   $user =  User::create([
            
            'nom' => 'Fatoumata DANSOKO', // Nom de l'utilisateur
            'email' => 'fatoumata.dansoko@unchk.edu.sn', // Email unique
            'password' => bcrypt('password'), // Mot de passe
            'telephone' => '+221770374697', // Numéro de téléphone
            'adresse' => '123 Admin St, Admin City', // Adresse
            'status' => 'active', // Statut
            'remember_token' => null, // Vous pouvez laisser ceci vide ou générer un token
            'logo' => 'logo.png', //
        ]);
        $user->assignRole('admin');
    }
}
