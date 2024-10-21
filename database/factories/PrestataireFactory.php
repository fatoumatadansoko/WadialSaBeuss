<?php

// database/factories/PrestataireFactory.php
use App\Models\Prestataire;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrestatairesFactory extends Factory
{
    protected $model = Prestataire::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // Crée automatiquement un utilisateur
            'categorie_prestataire_id' => 1, // Tu peux utiliser des valeurs spécifiques ou un autre factory
            'logo' => $this->faker->imageUrl(200, 200, 'business'),
            'ninea' => $this->faker->unique()->numerify('#########'),
            'disponibilite' => $this->faker->randomElement(['disponible', 'occupé']),
        ];
    }
}

