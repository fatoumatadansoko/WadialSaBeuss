<?php

// database/factories/UserFactory.php
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // ou Hash::make('password')
            'telephone' => $this->faker->phoneNumber,
            'adresse' => $this->faker->address,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'description' => $this->faker->sentence,
            'role' => $this->faker->randomElement(['client', 'prestataire']), // ou 'admin' si nécessaire
            'remember_token' => Str::random(10),
        ];
    }
}

