<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create permissions
        $permissions = [
            'create-books',
            'edit-books',
            'delete-books',
            'view-books',
            'borrow-books',
            'view-borrows',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Assign all permissions to admin
        $adminRole->syncPermissions(Permission::all());

        // Assign specific permissions to user
        $userPermissions = [
            'view-books',
            'borrow-books',
        ];
        $userRole->syncPermissions($userPermissions);

        // Create users and assign roles
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@rakaya.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('12345678'),
            ]
        );
        $adminUser->assignRole($adminRole);

        $regularUser = User::firstOrCreate(
            ['email' => 'user@rakaya.com'],
            [
                'name' => 'Regular User',
                'password' => bcrypt('12345678'),
            ]
        );
        $regularUser->assignRole($userRole);
    }
}
