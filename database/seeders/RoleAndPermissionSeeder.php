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

        Permission::create(['name' => 'create-stunt-gun']);
        Permission::create(['name' => 'edit-stunt-gun']);
        Permission::create(['name' => 'delete-stunt-gun']);
        Permission::create(['name' => 'retrieve-stunt-gun']);

        Permission::create(['name' => 'create-device-log']);
        Permission::create(['name' => 'edit-device-log']);
        Permission::create(['name' => 'delete-device-log']);
        Permission::create(['name' => 'retrieve-device-log']);

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
            'create-stunt-gun',
            'edit-stunt-gun',
            'delete-stunt-gun',
            'retrieve-stunt-gun',
            'create-device-log',
            'edit-device-log',
            'delete-device-log',
            'retrieve-device-log',
        ]);

        $clientRole->givePermissionTo([
            'create-contacts',
            'edit-contacts',
            'delete-contacts',
            'retrieve-contacts',
            'retrieve-stunt-gun',
            'create-device-log',
            'retrieve-device-log',

        ]);


        $user = User::first();
        $user->assignRole('Admin');

        $user = User::first();
        $user->givePermissionTo('create-users');
        $user->givePermissionTo('edit-users');
        $user->givePermissionTo('delete-users');
        $user->givePermissionTo('create-contacts');
        $user->givePermissionTo('edit-contacts');
        $user->givePermissionTo('delete-contacts');

    }
}
