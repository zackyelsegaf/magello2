<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make(12345),
            'remember_token' => Str::random(10),
            'role_name' => 'SuperAdmin'
        ];
    }

    public function SuperAdmin(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'role_name' => 'SuperAdmin',
        ]);
    }

    public function Marketing(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'role_name' => 'Marketing',
        ]);
    }

    public function Logistik(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'role_name' => 'Logistik',
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
