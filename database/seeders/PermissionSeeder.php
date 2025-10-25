<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userPermissions = [
            'group_name' => 'user',
            'names' => [
            'view-user',
            'create-user',
            'update-user',
            'delete-user',
            'show-user',
            'restore-user',
            'force-delete-user',]
        ];
        $rolePermissions = [
            'group_name' => 'role',
            'names' => [
            'view-role',
            'create-role',
            'update-role',
            'delete-role',
            'show-role',
            'restore-role',
            'force-delete-role',]
        ];
        $itemPermissions = [
            'group_name' => 'item',
            'names' => [
            'view-item',
            'create-item',
            'update-item',
            'delete-item',
            'show-item',
            'restore-item',
            'force-delete-item',]
        ];
        $groupPermissions = [
            'group_name' => 'group',
            'names' => [
            'view-group',
            'create-group',
            'update-group',
            'delete-group',
            'show-group',
            'restore-group',
            'force-delete-group',]
        ];
        $categoryPermissions = [
            'group_name' => 'category',
            'names' => [
            'view-category',
            'create-category',
            'update-category',
            'delete-category',
            'show-category',
            'restore-category',
            'force-delete-category',]
        ];
        foreach($userPermissions['names'] as $permission) {
            Permission::create([
                'group_name' => $userPermissions['group_name'],
                'name' => $permission,
            ]);
        }
        foreach($rolePermissions['names'] as $permission) {
            Permission::create([
                'group_name' => $rolePermissions['group_name'],
                'name' => $permission,
            ]);
        }
        foreach($itemPermissions['names'] as $permission) {
            Permission::create([
                'group_name' => $itemPermissions['group_name'],
                'name' => $permission,
            ]);
        }
        foreach($groupPermissions['names'] as $permission) {
            Permission::create([
                'group_name' => $groupPermissions['group_name'],
                'name' => $permission,
            ]);
        }
        foreach($categoryPermissions['names'] as $permission) {
            Permission::create([
                'group_name' => $categoryPermissions['group_name'],
                'name' => $permission,
            ]);
        }
    }
}
