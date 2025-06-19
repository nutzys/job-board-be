<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'employer']);

        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage posts']);
        Permission::create(['name' => 'manage roles']);
        Permission::create(['name' => 'manage permissions']);
        Permission::create(['name' => 'create posts']);

        Role::findByName('admin')->givePermissionTo([
            'manage users',
            'manage posts',
            'manage roles',
            'manage permissions',
            'create posts',
        ]);

        Role::findByName('user')->givePermissionTo([
            'manage posts',
        ]);

        Role::findByName('employer')->givePermissionTo([
            'manage posts',
            'create posts',
        ]);
    }
}
