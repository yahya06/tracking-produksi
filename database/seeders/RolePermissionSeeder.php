<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions
        $permissions = [
            'view tracking',
            'view dashboard',
            'manage product',
            'add product',
            'add variables',
            'manage division outputs',
            'manage all', // SuperAdmin
        ];

        foreach ($permissions as $permission) {
            ModelsPermission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $roles = [
            'Guest' => ['view tracking'],
            'SuperAdmin' => ['manage all'],
            'Manajer' => ['view dashboard'],
            'AdminProduksi' => ['manage product', 'add product', 'add variables', 'view tracking'],
            'Spv' => ['manage division outputs'],
        ];

        foreach ($roles as $role => $rolePermissions) {
            $roleObj = Role::firstOrCreate(['name' => $role]);
            $roleObj->syncPermissions($rolePermissions);
        }
    }
}
