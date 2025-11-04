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
        ]);
    }
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'User3',
            'email' => 'user3@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'User4',
            'email' => 'user4@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'User5',
            'email' => 'user5@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'User6',
            'email' => 'user6@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'User7',
            'email' => 'user7@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'User8',
            'email' => 'user8@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'User9',
            'email' => 'user9@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'User10',
            'email' => 'user10@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
