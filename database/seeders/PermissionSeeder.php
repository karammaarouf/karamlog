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
        $RolePermissions = [
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


        $permissions=[$userPermissions,$itemPermissions,$RolePermissions];


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
