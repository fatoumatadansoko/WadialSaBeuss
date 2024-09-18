<?php

// database/seeders/DatabaseSeeder.php
use Illuminate\Database\Seeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\ClientTableSeeder;
use Database\Seeders\PrestataireTableSeeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            PrestataireTableSeeder::class,
            ClientTableSeeder::class,
        ]);
    }
}