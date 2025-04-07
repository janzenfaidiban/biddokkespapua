<?php

namespace App\Providers;

use App\Models\Gelarbelakang;
use App\Models\Gelardepan;
use App\Models\Golongandarah;
use App\Models\Hubungankeluarga;
use App\Models\Intra;
use App\Models\Klasis;
use App\Models\Wilayah;
use App\Models\Jemaat;
use App\Models\Kartukeluarga;
use App\Models\Anggotakeluarga;
use App\Models\Jenispekerjaan;
use App\Models\Pendidikanterakhir;
use App\Models\Penyandangcacat;
use App\Models\Statusbaptis;
use App\Models\Statusdomisili;
use App\Models\Statuspernikahan;
use App\Models\Statussidi;
use App\Models\Suku;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();


        try {
            // Your super fun database stuff
            view()->share([

                // site information
                'siteTitle' => 'Si-PMKRI Jayapura',
                'siteDescription' => 'Sistem Informasi Pemuda Katolik Republik Indonesia Cabang Jayapura',

                'siteLogo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/84/Logo_PMKRI_Nasional.png/1200px-Logo_PMKRI_Nasional.png',
                'siteFavicon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/84/Logo_PMKRI_Nasional.png/1200px-Logo_PMKRI_Nasional.png',

                'author' => 'Avelinus Korey',

                // site copyright info
                'siteCopyright' => '<script>document.write(new Date().getFullYear())</script> &copy; Si-PMKRI Jayapura - Dikembangkan oleh by <a href="https://github.com/AvelinusKorey" target="_blank">Avelinus Korey</a>',
                
                // footer links
                'footerLinks' => 'footerLinks',

                // icons
                'iconSemuaData' => '<i class="fe-maximize"></i>',
                'iconTempatSampah' => '<i class="fe-trash-2"></i>',
                'iconPencarian' => '<i class="fe-search"></i>',
                'iconBatal' => '<i class="fe-x-circle"></i>',
                'iconTombolTambah' => '<i class="fe-plus-square"></i>',
                'iconTombolSimpan' => '<i class="fe-save"></i>',
                'iconTombolKembali' => '<i class="fe-arrow-left"></i>',
                'iconTombolDetail' => '<i class="fe-eye"></i>',
                'iconTombolUbah' => '<i class="fe-edit"></i>',
                'iconTombolKembalikan' => '<i class="fe-arrow-left"></i>',
                'iconTombolHapus' => '<i class="fe-trash-2"></i>',
                'iconTombolHapusPermanen' => '<i class="fe-trash"></i>',
                'iconLogin' => '<i class="fe-log-in"></i>',
                'iconEmail' => '<i class="fe-mail"></i>',
                'iconKataSandi' => '<i class="fe-lock"></i>',
                
                
                'iconLogin' => '<i class="fe-lock"></i>',
                'iconBeranda' => '<i class="fe-home"></i>',
                'iconFaq' => '<i class="fe-help-circle"></i>',
                'iconPanduan' => '<i class="fe-book-open"></i>',
                'iconPetaSitus' => '<i class="fe-map"></i>',
                'iconHakCipta' => '<i class="fe-star"></i>',
                'iconSyaratKetentuan' => '<i class="fe-alert-triangle"></i>',

                // emoji
                'emojiTambah' => '➕',
                'emojiUbah' => '✏️',
                'emojiSampah' => '🗑️',
                'emojiHapusPermanen' => '❌',
                'emojiDetail' => '🔍',
                'emojiCari' => '🔎',
                'emojiBerhasil' => '✅',
                'emojiGagal' => '❌',
                'emojiPeringatan' => '⚠️',
                'emojiInfo' => 'ℹ️',
                'emojiProses' => '⏳',
                'emojiUnggah' => '⬆️',
                'emojiUnduh' => '📥',
                'emojiDataBarang' => '📦',
                'emojiBarangMasuk' => '📥',
                'emojiBarangKeluar' => '📤',
                'emojiUsulan' => '📋',
                'emojiKonfirmasi' => '✅',
                'emojiRiwayat' => '📅',


            ]);
        } catch (\Exception $e) {
            // do nothing
        }
    }
}
