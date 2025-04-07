<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
            'desc' => 'Akun utama sebagai pengelola sistem secara keseluruhan termasuk mengelola data dasar dan data anggota.',
        ]);

        Role::create([
            'name' => 'pimpinan',
            'guard_name' => 'web',
            'desc' => 'Akun pimpinan yang bertugas untuk melihat laporan data dan mengawasi sistem informasi.',
        ]);
        
    }
}
