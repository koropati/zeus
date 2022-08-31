<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'retrieve-master-data']);

        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'update-users']);
        Permission::create(['name' => 'delete-users']);
        Permission::create(['name' => 'retrieve-users']);

        Permission::create(['name' => 'create-contacts']);
        Permission::create(['name' => 'update-contacts']);
        Permission::create(['name' => 'delete-contacts']);
        Permission::create(['name' => 'retrieve-contacts']);

        Permission::create(['name' => 'create-my-contacts']);
        Permission::create(['name' => 'update-my-contacts']);
        Permission::create(['name' => 'delete-my-contacts']);
        Permission::create(['name' => 'retrieve-my-contacts']);

        Permission::create(['name' => 'create-devices']);
        Permission::create(['name' => 'update-devices']);
        Permission::create(['name' => 'delete-devices']);
        Permission::create(['name' => 'retrieve-devices']);
        Permission::create(['name' => 'retrieve-my-devices']);

        Permission::create(['name' => 'create-device-logs']);
        Permission::create(['name' => 'update-device-logs']);
        Permission::create(['name' => 'delete-device-logs']);
        Permission::create(['name' => 'retrieve-device-logs']);
        Permission::create(['name' => 'retrieve-my-device-logs']);

        Permission::create(['name' => 'update-profile']);
        Permission::create(['name' => 'retrieve-profile']);

        $adminRole = Role::create(['name' => 'Admin']);
        $clientRole = Role::create(['name' => 'Client']);

        $adminRole->givePermissionTo([
            'retrieve-master-data',
            
            'create-users',
            'update-users',
            'delete-users',
            'retrieve-users',

            'create-contacts',
            'update-contacts',
            'delete-contacts',
            'retrieve-contacts',

            'create-my-contacts',
            'update-my-contacts',
            'delete-my-contacts',
            'retrieve-my-contacts',

            'create-devices',
            'update-devices',
            'delete-devices',
            'retrieve-devices',
            'retrieve-my-devices',

            'create-device-logs',
            'update-device-logs',
            'delete-device-logs',
            'retrieve-device-logs',
            'retrieve-my-device-logs',

            'update-profile',
            'retrieve-profile',

        ]);

        $clientRole->givePermissionTo([
            'create-my-contacts',
            'update-my-contacts',
            'delete-my-contacts',
            'retrieve-my-contacts',

            'retrieve-my-devices',
            'retrieve-my-device-logs',

            'update-profile',
            'retrieve-profile',
        ]);


        $user = User::first();
        $user->assignRole('Admin');
    }
}
