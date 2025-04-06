<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

    /*
    | ==========================================
    | Data Admin Master
    |*/

    public function run(): void
    {
        $admin = user::create(
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('admin@mail.com'),
                'avatar' => 'assets/images/users/user-man-1.png',
            ],
        );
        $admin->assignRole('admin');

        $operator = user::create(
            [
                'name' => 'Operator',
                'username' => 'operator',
                'email' => 'operator@mail.com',
                'password' => bcrypt('operator@mail.com'),
                'avatar' => 'assets/images/users/user-man-1.png',
            ],
        );
        $operator->assignRole('operator');


    }


}
