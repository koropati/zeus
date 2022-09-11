<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Account;
use App\AccountPlan\AccountPlan;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin Zeus',
            'email' => 'admin@gmail.com',
            'phone_number' => round(microtime(true) * 1000),
            'password' => bcrypt('Password123'),
            'email_verified_at' => now(),
        ]);

        $account = new AccountPlan;
        $user->account()->save($account->getEnterprise());

    }
}
