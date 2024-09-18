<?php

// database/factories/ClientFactory.php
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientsFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // Crée automatiquement un utilisateur
        ];
    }
}
