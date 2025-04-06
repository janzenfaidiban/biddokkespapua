<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barang = [
            ['nama_barang' => 'Paracetamol', 'kategori' => 'obat', 'stok' => 100, 'harga_satuan' => 1000, 'keterangan' => 'Pereda nyeri dan demam'],
            ['nama_barang' => 'Amoxicillin', 'kategori' => 'obat', 'stok' => 50, 'harga_satuan' => 2500, 'keterangan' => 'Antibiotik'],
            ['nama_barang' => 'Ibuprofen', 'kategori' => 'obat', 'stok' => 80, 'harga_satuan' => 1500, 'keterangan' => 'Anti inflamasi'],
            ['nama_barang' => 'Masker Bedah', 'kategori' => 'bhp', 'stok' => 200, 'harga_satuan' => 500, 'keterangan' => 'Alat pelindung diri'],
            ['nama_barang' => 'Sarung Tangan Medis', 'kategori' => 'bhp', 'stok' => 150, 'harga_satuan' => 750, 'keterangan' => 'Untuk tindakan medis'],
            ['nama_barang' => 'Kapas Steril', 'kategori' => 'bhp', 'stok' => 300, 'harga_satuan' => 200, 'keterangan' => 'Untuk membersihkan luka'],
            ['nama_barang' => 'Cetirizine', 'kategori' => 'obat', 'stok' => 60, 'harga_satuan' => 2000, 'keterangan' => 'Antihistamin'],
            ['nama_barang' => 'Plester Luka', 'kategori' => 'bhp', 'stok' => 400, 'harga_satuan' => 300, 'keterangan' => 'Penutup luka kecil'],
            ['nama_barang' => 'Omeprazole', 'kategori' => 'obat', 'stok' => 70, 'harga_satuan' => 3000, 'keterangan' => 'Obat lambung'],
            ['nama_barang' => 'Perban Elastis', 'kategori' => 'bhp', 'stok' => 250, 'harga_satuan' => 1000, 'keterangan' => 'Pembalut luka'],
        ];

        foreach ($barang as $item) {
            Barang::create($item);
        }
    }
}