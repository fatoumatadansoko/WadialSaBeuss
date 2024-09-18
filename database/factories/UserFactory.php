<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // Hasher le mot de passe
            'telephone' => $this->faker->phoneNumber(),
            'addresse' => $this->faker->address(),
            'status' => 'actif',
            'description' => $this->faker->sentence(),
        ];
    }
}
