<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'email'  => $this->faker->userName(),
        'password'  => $this->faker->password(),
//        'role' => $this->faker->boolean(),
        'verify' => $this->faker->boolean(),
        ];
    }
}
