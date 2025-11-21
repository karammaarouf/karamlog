<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=['view-users',
        'create-users',
        'update-users',
        'delete-users',
        'restore-users',
        'force-delete-users'
    ];
    foreach($permissions as $permission){
        Permission::create([
            'name'=>$permission,
            'guard_name'=>'web',
            'group_name'=>'users'
        ]);
    }
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        for($i=0;$i<20;$i++){
            User::create([
                'name' => 'User'.$i,
                'email' => 'user'.$i.'@gmail.com',
                'password' => bcrypt('password'),
            ]);
        }
    }
}
