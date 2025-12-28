<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole=Role::create([
            'name'=>'super-admin',
            'guard_name'=>'web',
            'description'=>'Super Admin Role with all permissions',
        ]);
        $superAdminRole->givePermissionTo(Permission::all());
    }
}
