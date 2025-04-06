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

                // menu wilayah
                // 'topbarmenu_dropdown_wilayahs' => Wilayah::first('id')->all(),
                // 'topbarmenu_dropdown_klasiss' => Klasis::first('id')->all(),

                // site information
                'siteTitle' => 'Database GKI Klasis Waibu Moi',

                // site copyright info
                'siteCopyright' => '<script>document.write(new Date().getFullYear())</script> &copy; Database Online GKI Klasis Waibu Moi - Didukung dan dikembangkan oleh <a href="https://nokensoft.com" target="_blank">Nokensoft.com</a>',
                
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
                
                
                'iconHalamanLogin' => '<i class="fe-lock"></i>',
                'iconHalamanBeranda' => '<i class="fe-home"></i>',
                'iconHalamanKeluarga' => '<i class="fe-users"></i>',
                'iconHalamanFaq' => '<i class="fe-help-circle"></i>',
                'iconHalamanPanduan' => '<i class="fe-book-open"></i>',
                'iconHalamanPetaSitus' => '<i class="fe-map"></i>',
                'iconHalamanHakCipta' => '<i class="fe-star"></i>',
                'iconHalamanSyaratKetentuan' => '<i class="fe-alert-triangle"></i>',




                // media sosial
                'linkContohInstagram' => 'https://instagram.com/gkiefatadosay',
                'linkContohFacebook' => 'https://facebook.com/gkiefatadosay',
                'linkContohWaChannel' => 'https://whatsapp.com/channel/0029VaeL5uo5PO0vdDy3rW2T',
                'linkContohYoutube' => 'https://youtube.com/@gkiefatadosay',


                // template file
                'linkTemplateStrukturOrganisasi' => 'https://docs.google.com/spreadsheets/d/1VBdAA3I-oDKsreZzHG_jVrDzlJSwhIf0cldj2Dp_KAk/edit?usp=sharing',
                'linkTemplateSaranaPrasarana' => 'https://docs.google.com/spreadsheets/d/1pHcgbqaUrF_xy4nRQ0kcBIkESXNTeIRtyOvKA1reRKQ/edit?usp=sharing',

            ]);
        } catch (\Exception $e) {
            // do nothing
        }
    }
}
