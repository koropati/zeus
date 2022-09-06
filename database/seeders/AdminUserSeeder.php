<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Account;

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

        $account = new Account;
        $account->account_type = "enterprise";
        $account->device_number = 1000;
        $account->request = 99999;
        $account->expired_at = "2025-01-01";
        $account->is_active = true;

        $user->account()->save($account);


        
    }
}
