<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
   public function run()
    {
        Categorie::create([
            'titre' => 'Mariage',
            'description' => 'Catégorie pour les événements de mariage au Sénégal'
        ]);

        Categorie::create([
            'titre' => 'Baptême',
            'description' => 'Catégorie pour les cérémonies de baptême au Sénégal'
        ]);

        Categorie::create([
            'titre' => 'Anniversaire',
            'description' => 'Catégorie pour les fêtes d’anniversaire au Sénégal'
        ]);
    }
}
