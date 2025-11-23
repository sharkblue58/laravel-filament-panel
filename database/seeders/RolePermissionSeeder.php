<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->createPermissions();
        $this->createRoles();
    }

    protected function createPermissions(): void
    {
        $permissions = [
            'test.user',
            'test.admin',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }
    }

    protected function createRoles(): void
    {
        // User role
        $user = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web'
        ]);
        $user->syncPermissions(['test.user']);

        // Admin role
        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        $admin->syncPermissions(['test.admin']);

        // Super Admin role - gets all permissions
        $superAdmin = Role::firstOrCreate([
            'name' => 'super admin',
            'guard_name' => 'web'
        ]);
        $superAdmin->syncPermissions(Permission::all());
    }
}
