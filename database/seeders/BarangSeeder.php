<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barang = [
            ['nama_barang' => 'Paracetamol', 'kategori' => 'obat', 'harga_satuan' => 1000, 'keterangan' => 'Pereda nyeri dan demam'],
            ['nama_barang' => 'Amoxicillin', 'kategori' => 'obat', 'harga_satuan' => 2500, 'keterangan' => 'Antibiotik'],
            ['nama_barang' => 'Ibuprofen', 'kategori' => 'obat', 'harga_satuan' => 1500, 'keterangan' => 'Anti inflamasi'],
            ['nama_barang' => 'Masker Bedah', 'kategori' => 'bhp', 'harga_satuan' => 500, 'keterangan' => 'Alat pelindung diri'],
            ['nama_barang' => 'Sarung Tangan Medis', 'kategori' => 'bhp', 'harga_satuan' => 750, 'keterangan' => 'Untuk tindakan medis'],
            ['nama_barang' => 'Kapas Steril', 'kategori' => 'bhp', 'harga_satuan' => 200, 'keterangan' => 'Untuk membersihkan luka'],
            ['nama_barang' => 'Cetirizine', 'kategori' => 'obat', 'harga_satuan' => 2000, 'keterangan' => 'Antihistamin'],
            ['nama_barang' => 'Plester Luka', 'kategori' => 'bhp', 'harga_satuan' => 300, 'keterangan' => 'Penutup luka kecil'],
            ['nama_barang' => 'Omeprazole', 'kategori' => 'obat', 'harga_satuan' => 3000, 'keterangan' => 'Obat lambung'],
            ['nama_barang' => 'Perban Elastis', 'kategori' => 'bhp', 'harga_satuan' => 1000, 'keterangan' => 'Pembalut luka'],
            ['nama_barang' => 'Vitamin C', 'kategori' => 'obat', 'harga_satuan' => 1200, 'keterangan' => 'Suplemen daya tahan tubuh'],
            ['nama_barang' => 'Thermometer Digital', 'kategori' => 'bhp', 'harga_satuan' => 15000, 'keterangan' => 'Pengukur suhu tubuh'],
            ['nama_barang' => 'Salep Kulit', 'kategori' => 'obat', 'harga_satuan' => 2500, 'keterangan' => 'Untuk iritasi kulit'],
            ['nama_barang' => 'Alkohol 70%', 'kategori' => 'bhp', 'harga_satuan' => 3000, 'keterangan' => 'Antiseptik luka'],
            ['nama_barang' => 'Loratadine', 'kategori' => 'obat', 'harga_satuan' => 2200, 'keterangan' => 'Antialergi'],
            ['nama_barang' => 'Kain Kasa', 'kategori' => 'bhp', 'harga_satuan' => 400, 'keterangan' => 'Pembalut luka'],
            ['nama_barang' => 'Antasida', 'kategori' => 'obat', 'harga_satuan' => 1800, 'keterangan' => 'Untuk sakit maag'],
            ['nama_barang' => 'Spuit 5ml', 'kategori' => 'bhp', 'harga_satuan' => 600, 'keterangan' => 'Alat suntik'],
            ['nama_barang' => 'Neurobion', 'kategori' => 'obat', 'harga_satuan' => 3500, 'keterangan' => 'Vitamin B kompleks'],
            ['nama_barang' => 'Tensimeter Manual', 'kategori' => 'bhp', 'harga_satuan' => 50000, 'keterangan' => 'Alat ukur tekanan darah'],
        ];
        

        foreach ($barang as $item) {
            Barang::create($item);
        }
    }
}