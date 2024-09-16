<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'titre' => 'Anniversaire',
                'description' => 'Produits fabriqués à la main au Sénégal.',
            ],
            [
                'nom' => 'Mariage',
                'description' => 'Produits alimentaires typiques du Sénégal.',
            ],
            // Ajoutez d'autres catégories ici
        ]);
    }
}
