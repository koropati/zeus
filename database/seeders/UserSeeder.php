<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $gender = $faker->randomElement(['male', 'female']);

        foreach (range(1,200) as $index) {
            $user = User::create([
                'name' => $faker->name($gender),
                'email' => $faker->email,
                'password' => bcrypt('PasswordUser123'),
                'email_verified_at' => now(),
            ]);

            $user->assignRole('Client');
        }
    }
}
