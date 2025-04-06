<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggotakeluarga;
use Carbon\Carbon;

class AnggotakeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Anggotakeluarga::create(
            [
                "no_kk" => 1234567890,
                "hubungan_keluarga_id" => 1,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Janzen',
                "nama_tengah" => '',
                "nama_belakang" => 'Faidiban',
                "jenis_kelamin" => 'Laki-Laki',
                
                "keterangan" => '',
            ]
        );
        Anggotakeluarga::create(
            [
                "no_kk" => 1234567899,
                "hubungan_keluarga_id" => 1,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Samuel',
                "nama_tengah" => '',
                "nama_belakang" => 'Bosawer',
                "jenis_kelamin" => 'Laki-Laki',
                
                "keterangan" => '',
            ]
        );
        
        Anggotakeluarga::create(
            [
                "no_kk" => 1234567990,
                "hubungan_keluarga_id" => 1,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Maikel',
                "nama_tengah" => '',
                "nama_belakang" => 'Kayame',
                "jenis_kelamin" => 'Laki-Laki',
                
                "keterangan" => '',
            ]
        );
        
        Anggotakeluarga::create(
            [
                "no_kk" => 1234561899,
                "hubungan_keluarga_id" => 1,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Billy',
                "nama_tengah" => '',
                "nama_belakang" => 'Rumbiak',
                "jenis_kelamin" => 'Laki-Laki',
                
                "keterangan" => '',
            ]
        );
        
        Anggotakeluarga::create(
            [
                "no_kk" => 1234561899,
                "hubungan_keluarga_id" => 2,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Insos',
                "nama_tengah" => '',
                "nama_belakang" => 'Rumbiak',
                "jenis_kelamin" => 'Laki-Laki',
                
                "keterangan" => '',
            ]
        );

        // jemaat gki waibron bano
        
        Anggotakeluarga::create(
            [
                "no_kk" => 1234561879,
                "hubungan_keluarga_id" => 2,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'anggota keluarga',
                "nama_tengah" => '',
                "nama_belakang" => 'jemaat gki waibron bano',
                "jenis_kelamin" => 'Laki-Laki',
                
                "keterangan" => '',
            ]
        );

        // jemaat gki efata dosay

        // keluarga: Blandina Done
        Anggotakeluarga::create(
            [
                "no_kk" => 1234561858,
                "hubungan_keluarga_id" => 1,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Blandina',
                "nama_tengah" => '',
                "nama_belakang" => 'Done',
                "jenis_kelamin" => 'Perempuan',
                
                "keterangan" => 'Anggota jemaat GKI Efata Dosay',
            ]
        );
        
        Anggotakeluarga::create(
            [
                "no_kk" => 1234561858,
                "hubungan_keluarga_id" => 3,
                "golongan_darah_id" => 1,
                "status_baptis_id" => 1,
                "status_sidi_id" => '1',
                "intra_id" => 2,
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Michael',
                "nama_tengah" => 'Janzen',
                "nama_belakang" => 'Faidiban',
                "jenis_kelamin" => 'Laki-Laki',
                
                "keterangan" => 'Anggota jemaat GKI Efata Dosay',
            ]
        );
        
        Anggotakeluarga::create(
            [
                "no_kk" => 1234561858,
                "hubungan_keluarga_id" => 3,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Elsina',
                "nama_tengah" => 'Margarteh',
                "nama_belakang" => 'Faidiban',
                "jenis_kelamin" => 'Perempuan',
                
                "keterangan" => 'Anggota jemaat GKI Efata Dosay',
            ]
        );
        
        Anggotakeluarga::create(
            [
                "no_kk" => 1234561858,
                "hubungan_keluarga_id" => 3,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Olga',
                "nama_tengah" => 'Aprilia',
                "nama_belakang" => 'Faidiban',
                "jenis_kelamin" => 'Perempuan',
                
                "keterangan" => 'Anggota jemaat GKI Efata Dosay',
            ]
        );
        
        Anggotakeluarga::create(
            [
                "no_kk" => 1234561858,
                "hubungan_keluarga_id" => 3,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Louisa',
                "nama_tengah" => 'Basyeba',
                "nama_belakang" => 'Faidiban',
                "jenis_kelamin" => 'Perempuan',
                
                "keterangan" => 'Anggota jemaat GKI Efata Dosay',
            ]
        );
        
        // keluarga: Djufri Faidiban
        Anggotakeluarga::create(
            [
                "no_kk" => 1234561860,
                "hubungan_keluarga_id" => 1,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Djufri',
                "nama_tengah" => '',
                "nama_belakang" => 'Pangemanan',
                "jenis_kelamin" => 'Laki-Laki',
                
                "keterangan" => '',
            ]
        );
        
        Anggotakeluarga::create(
            [
                "no_kk" => 1234561860,
                "hubungan_keluarga_id" => 2,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Irene',
                "nama_tengah" => '',
                "nama_belakang" => 'Done',
                "jenis_kelamin" => 'Perempuan',
                
                "keterangan" => '',
            ]
        );
        
        Anggotakeluarga::create(
            [
                "no_kk" => 1234561860,
                "hubungan_keluarga_id" => 4,
                // "golongan_darah_id" => '',
                // "status_baptis_id" => '',
                // "status_sidi_id" => '',
                // "intra_id" => '',
                // "status_pernikahan_id" => '',
                // "gelar_depan_id" => '',
                // "gelar_belakang_id" => '',
                // "jenis_pekerjaan_id" => '',
                // "status_domisisli_id" => '',
                // "penyandang_cacat_id" => '',
                // "pendidikan_terakhir_id" => '',
                // "suku_id" => '',

                "nama_depan" => 'Charen',
                "nama_tengah" => 'M',
                "nama_belakang" => 'Pangemanan',
                "jenis_kelamin" => 'Perempuan',
                
                "keterangan" => '',
            ]
        );

    }
}
