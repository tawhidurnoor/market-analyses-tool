<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //we are basically creating permissions and assigning theme to suoer user

        // Create Roles
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleProductManager = Role::create(['name' => 'product_manager']);
        $roleSaleManager = Role::create(['name' => 'sale_manager']);
        $roleUser = Role::create(['name' => 'user']);


        // Permission List as array
        $permissions = [

            [
                'group_name' => 'trending',
                'permissions' => [
                    'trending.view',
                ],
            ],
            [
                'group_name' => 'analysis',
                'permissions' => [
                    'analysis.view',
                ],
            ],
            [
                'group_name' => 'users',
                'permissions' => [
                    'users.create',
                    'users.view',
                    'users.edit',
                    'users.delete',
                ],
            ],
            [
                'group_name' => 'roles',
                'permissions' => [
                    'roles.create',
                    'roles.view',
                    'roles.edit',
                    'roles.delete',
                ],
            ],
            [
                'group_name' => 'category',
                'permissions' => [
                    'category.create',
                    'category.view',
                    'category.edit',
                    'category.delete',
                ],
            ],
            [
                'group_name' => 'subcategory',
                'permissions' => [
                    'subcategory.create',
                    'subcategory.view',
                    'subcategory.edit',
                    'subcategory.delete',
                ],
            ],
            [
                'group_name' => 'products',
                'permissions' => [
                    'products.create',
                    'products.view',
                    'products.edit',
                    'products.delete',
                ],
            ],
            [
                'group_name' => 'sale',
                'permissions' => [
                    'sale.create',
                    'sale.view',
                    'sale.edit',
                    'sale.delete',
                ],
            ],
        ];

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
    }
}
