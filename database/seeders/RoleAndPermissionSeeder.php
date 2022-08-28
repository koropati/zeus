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
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);
        Permission::create(['name' => 'retrieve-users']);

        Permission::create(['name' => 'create-contacts']);
        Permission::create(['name' => 'edit-contacts']);
        Permission::create(['name' => 'delete-contacts']);
        Permission::create(['name' => 'retrieve-contacts']);

        Permission::create(['name' => 'create-my-contacts']);
        Permission::create(['name' => 'edit-my-contacts']);
        Permission::create(['name' => 'delete-my-contacts']);
        Permission::create(['name' => 'retrieve-my-contacts']);

        Permission::create(['name' => 'create-devices']);
        Permission::create(['name' => 'edit-devices']);
        Permission::create(['name' => 'delete-devices']);
        Permission::create(['name' => 'retrieve-devices']);
        Permission::create(['name' => 'retrieve-my-devices']);

        Permission::create(['name' => 'create-device-logs']);
        Permission::create(['name' => 'edit-device-logs']);
        Permission::create(['name' => 'delete-device-logs']);
        Permission::create(['name' => 'retrieve-device-logs']);

        $adminRole = Role::create(['name' => 'Admin']);
        $clientRole = Role::create(['name' => 'Client']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'retrieve-users',

            'create-contacts',
            'edit-contacts',
            'delete-contacts',
            'retrieve-contacts',

            'create-my-contacts',
            'edit-my-contacts',
            'delete-my-contacts',
            'retrieve-my-contacts',

            'create-devices',
            'edit-devices',
            'delete-devices',
            'retrieve-devices',
            'retrieve-my-devices',

            'create-device-logs',
            'edit-device-logs',
            'delete-device-logs',
            'retrieve-device-logs',
        ]);

        $clientRole->givePermissionTo([
            'create-my-contacts',
            'edit-my-contacts',
            'delete-my-contacts',
            'retrieve-my-contacts',

            'retrieve-my-devices',
            'create-device-logs',
            'retrieve-device-logs',
        ]);


        $user = User::first();
        $user->assignRole('Admin');
    }
}
