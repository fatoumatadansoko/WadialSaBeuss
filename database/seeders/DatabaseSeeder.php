<?php

// database/seeders/DatabaseSeeder.php
use Illuminate\Database\Seeder;
use Database\Seeders\VoteSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\CategorieSeeder;
use Database\Seeders\EvenementSeeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\ClientTableSeeder;
use Database\Seeders\CommentaireSeeder;
use Database\Seeders\CarteInvitationSeeder;
use Database\Seeders\PrestataireTableSeeder;
use Database\Seeders\CartePersonnaliseeSeeder;
use Database\Seeders\CategoriePrestataireSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {  $this->call([
        CategoriePrestataireSeeder::class, 
        CategorieSeeder::class,
        EvenementSeeder::class,
        PrestataireTableSeeder::class,
        CarteInvitationSeeder::class,
        CartePersonnaliseeSeeder::class,
        CommentaireSeeder::class,
        VoteSeeder::class,
        ImageSeeder::class,
    ]);
    }
}