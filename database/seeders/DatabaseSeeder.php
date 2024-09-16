<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Appeler le seeder des utilisateurs
        $this->call([
            // UserSeeder::class,
            AdminSeeder::class,
            // PrestataireSeeder::class,
            CategoriePrestataireSeeder::class,
            ImageSeeder::class,
            // ClientSeeder::class,
            // CommentaireSeeder::class,
            CarteInvitationSeeder::class,
            CartePersonnaliseeSeeder::class,
            // CategorieSeeder::class,
            EvenementSeeder::class,
            NotificationSeeder::class,
            // PrestataireSeeder::class,
            VoteSeeder::class,
            CategoriePrestataireSeeder::class,
        ]);
    }
}
