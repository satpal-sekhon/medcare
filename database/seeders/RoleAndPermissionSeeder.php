<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'create categories',
            'view categories',
            'edit categories',
            'delete categories',

            'create subcategories',
            'view subcategories',
            'edit subcategories',
            'delete subcategories',

            'create brands',
            'view brands',
            'edit brands',
            'delete brands',

            'create products',
            'view products',
            'edit products',
            'delete products',

            'create invoices',
            'view invoices',
            'edit invoices',
            'delete invoices',

            'create orders',
            'view orders',
            'edit orders',
            'delete orders',
            
            'create users',
            'view users',
            'edit users',
            'delete users',
            
            'create customers',
            'view customers',
            'edit customers',
            'delete customers',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define roles and their permissions
        $roles = [
            'Admin' => $permissions, // Admin gets all permissions
            'Pharmacy' => [
                'view categories',
                'view subcategories',
                'view brands',
                'view products'
            ],
            'Customer' => []
        ];
        
        // Create roles and assign permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
        
            // Assign permissions to the role
            foreach ($rolePermissions as $permission) {
                $permissionObj = Permission::where('name', $permission)->first();
                if ($permissionObj) {
                    $role->givePermissionTo($permissionObj);
                }
            }
        }
        
    }
}
