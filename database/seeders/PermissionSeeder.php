<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userPermissions = [
            'group_name' =>'users',
            'guard_name' =>'web',
            'permissions' =>[
                'view-users',
                'show-users',
                'create-users',
                'update-users',
                'delete-users',
                'restore-users',
                'force-delete-users'
            ]
        ];
        $itemPermissions = [
            'group_name' =>'items',
            'guard_name' =>'web',
            'permissions' =>[
                'view-items',
                'show-items',
                'create-items',
                'update-items',
                'delete-items',
                'restore-items',
                'force-delete-items'
            ]
        ];
        $rolePermissions = [
            'group_name' =>'roles',
            'guard_name' =>'web',
            'permissions' =>[
                'view-roles',
                'show-roles',
                'create-roles',
                'update-roles',
                'delete-roles',
            ]
        ];
        $categoryPermissions = [
            'group_name' =>'categories',
            'guard_name' =>'web',
            'permissions' =>[
                'view-categories',
                'create-categories',
                'update-categories',
                'delete-categories',
                'restore-categories',
                'force-delete-categories',
            ]
        ];
        $groupPermissions = [
            'group_name' => 'groups',
            'guard_name' => 'web',
            'permissions' => [
                'view-groups',
                'show-groups',
                'create-groups',
                'update-groups',
                'delete-groups',
                'restore-groups',
                'force-delete-groups',
            ]
        ];

        $permissions=[$userPermissions,$itemPermissions,$rolePermissions,$categoryPermissions,$groupPermissions];


        foreach($permissions as $permission){
            foreach($permission['permissions'] as $permissionName){
                Permission::create([
                    'name'=>$permissionName,
                    'guard_name'=>$permission['guard_name'],
                    'group_name'=>$permission['group_name']
                ]);
            }
        }
    }
}
