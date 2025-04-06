<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Poliklinik;

class PoliklinikSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_poliklinik' => 'Poliklinik Polda Papua',
                'alamat' => 'Jl. Polisi No. 1, Jayapura',
                'nama_kepala' => 'Dr. Andi Saputra',
                'no_telp' => '081234567890',
                'email' => 'polda@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik SPN Polda Papua',
                'alamat' => 'Jl. Pendidikan Polri No. 2, Jayapura',
                'nama_kepala' => 'Dr. Sari Puspita',
                'no_telp' => '081298765432',
                'email' => 'spn@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Brimob',
                'alamat' => 'Jl. Brimob No. 3, Kotaraja',
                'nama_kepala' => 'Dr. Rendy Yulianto',
                'no_telp' => '081345678901',
                'email' => 'brimob@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Polresta',
                'alamat' => 'Jl. Polisi Kota No. 4, Jayapura',
                'nama_kepala' => 'Dr. Nadia Kusuma',
                'no_telp' => '081356789012',
                'email' => 'polresta@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Polres Jayapura',
                'alamat' => 'Jl. Sentani No. 5, Sentani',
                'nama_kepala' => 'Dr. Imam Basuki',
                'no_telp' => '081367890123',
                'email' => 'jayapura@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Polres Keerom',
                'alamat' => 'Jl. Arso No. 6, Keerom',
                'nama_kepala' => 'Dr. Ayu Lestari',
                'no_telp' => '081378901234',
                'email' => 'keerom@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Polres Biak Numfor',
                'alamat' => 'Jl. Raya Bosnik No. 7, Biak',
                'nama_kepala' => 'Dr. Faisal Ridwan',
                'no_telp' => '081389012345',
                'email' => 'biak@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Polres Nabire',
                'alamat' => 'Jl. Samabusa No. 8, Nabire',
                'nama_kepala' => 'Dr. Fitri Hapsari',
                'no_telp' => '081390123456',
                'email' => 'nabire@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Polres Kepulauan Yapen',
                'alamat' => 'Jl. Serui Laut No. 9, Yapen',
                'nama_kepala' => 'Dr. Budi Hartono',
                'no_telp' => '081401234567',
                'email' => 'yapen@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Polres Mimika',
                'alamat' => 'Jl. SP2 No. 10, Timika',
                'nama_kepala' => 'Dr. Ilham Suhendra',
                'no_telp' => '081412345678',
                'email' => 'mimika@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Polres Jayawijaya',
                'alamat' => 'Jl. Trikora No. 11, Wamena',
                'nama_kepala' => 'Dr. Lestari Putri',
                'no_telp' => '081423456789',
                'email' => 'jayawijaya@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Polres Boven Digoel',
                'alamat' => 'Jl. Trans Papua No. 12, Tanah Merah',
                'nama_kepala' => 'Dr. Aldi Wijaya',
                'no_telp' => '081434567890',
                'email' => 'boven@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Polres Merauke',
                'alamat' => 'Jl. Nowari No. 13, Merauke',
                'nama_kepala' => 'Dr. Rina Mulyani',
                'no_telp' => '081445678901',
                'email' => 'merauke@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Dummy A',
                'alamat' => 'Jl. Dummy A',
                'nama_kepala' => 'Dr. Dummy A',
                'no_telp' => '081200000001',
                'email' => 'dummyA@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Dummy B',
                'alamat' => 'Jl. Dummy B',
                'nama_kepala' => 'Dr. Dummy B',
                'no_telp' => '081200000002',
                'email' => 'dummyB@poliklinik.com',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($data as $item) {
            Poliklinik::create($item);
        }
        
        // Soft delete dua data tersebut
        Poliklinik::where('email', 'dummyA@poliklinik.com')->first()->delete();
        Poliklinik::where('email', 'dummyB@poliklinik.com')->first()->delete();

    }
}
