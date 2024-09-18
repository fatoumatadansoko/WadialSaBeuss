<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Commentaire::create([
            'contenu' => 'Service impeccable !',
            'date_ajout' => now(),
            'client_id' => 1,
            'prestataire_id' => 1,
        ]);

        Commentaire::create([
            'contenu' => 'Très satisfait des prestations.',
            'date_ajout' => now(),
            'client_id' => 2,
            'prestataire_id' => 2,
        ]);
        }
}
