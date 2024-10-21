<?php

namespace Database\Seeders;

use App\Models\CarteInvitation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarteInvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarteInvitation::create([
            'nom' => 'Mariage de Fatou et Modou',
            'image' => 'mariage-fatou-modou.png',
            'contenu' => 'Vous êtes cordialement invités à notre mariage qui aura lieu à Dakar.',
            'user_id' => 7,
            'categorie_id' => 1,
        ]);

        CarteInvitation::create([
            'nom' => 'Baptême de Samba',
            'image' => 'bapteme-samba.png',
            'contenu' => 'Venez célébrer le baptême de notre fils Samba, le samedi prochain.',
            'user_id' => 7,
            'categorie_id' => 2,
        ]);
        }
}
