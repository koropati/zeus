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

        Permission::create(['name' => 'create-contacts']);
        Permission::create(['name' => 'edit-contacts']);
        Permission::create(['name' => 'delete-contacts']);

        $adminRole = Role::create(['name' => 'Admin']);
        $clientRole = Role::create(['name' => 'Client']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-contacts',
            'edit-contacts',
            'delete-contacts',
        ]);

        $clientRole->givePermissionTo([
            'create-contacts',
            'edit-contacts',
            'delete-contacts',
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
