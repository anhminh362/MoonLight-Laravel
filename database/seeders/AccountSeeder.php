<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $limit=10;
        for($i=0;$i < $limit; $i++){
//         DB:table('accounts')->insert([
//                 'email'=>$faker->unique()->safeEmail,
//                 'password'=>bcrypt('password')
//                 ])
            Account::create([
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),

            ]);

        }
//         Account::factory()
//         ->count(10),
//         ->create()
    }
}
