<?php

namespace Database\Factories;
use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
//use Faker\Generator as Faker;

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
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'account_id' => function () {
                // Get a random verified account from the database
                $verifiedAccount = Account::where('verify', true)->inRandomOrder()->first();

                // If a verified account exists, return its id; otherwise, create a new verified account and return its id
                return $verifiedAccount ? $verifiedAccount->id : Account::factory()->create(['verify' => true])->id;
            },
            'name'=>fake()->name(),
            'phone'=>$this->faker->phoneNumber(),
        ];
    }
}
