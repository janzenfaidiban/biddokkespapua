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

        // user role:admin
        $admin = user::create(
            [
                'name' => 'Admin Kesekretariatan 1',
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('admin@mail.com'),
                'avatar' => 'assets/img/sacode-profile-1.png',
            ],
        );
        $admin->assignRole('admin');

        
        $admin = user::create(
            [
                'name' => 'Admin Kesekretariatan 2',
                'username' => 'admin2',
                'email' => 'admin2@mail.com',
                'password' => bcrypt('admin2@mail.com'),
                'avatar' => 'assets/img/sacode-profile-2.png',
            ],
        );
        $admin->assignRole('admin');

        // user role:pimpinan
        $pimpinan = user::create(
            [
                'name' => 'Sekretaris Jenderal',
                'username' => 'sekjen',
                'email' => 'sekjen@mail.com',
                'password' => bcrypt('sekjen@mail.com'),
                'avatar' => 'assets/img/sacode-profile-3.png',
            ],
        );
        $pimpinan->assignRole('pimpinan');

        
        $pimpinan = user::create(
            [
                'name' => 'Wakil Sekretaris Jenderal',
                'username' => 'wakil.sekjen',
                'email' => 'wakil.sekjen@mail.com',
                'password' => bcrypt('wakil.sekjen@mail.com'),
                'avatar' => 'assets/img/sacode-profile-3.png',
            ],
        );
        $pimpinan->assignRole('pimpinan');


    }


}
