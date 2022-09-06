<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Account;
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
                'phone_number' => round(microtime(true) * 1000),
                'password' => bcrypt('PasswordUser123'),
                'email_verified_at' => now(),
            ]);

            $account = new Account;
            $account->account_type = "free";
            $account->device_number = 2;
            $account->request = 100;
            $account->expired_at = "2025-01-01";
            $account->is_active = true;

            $user->account()->save($account);

            $user->assignRole('Client');
        }
    }
}
