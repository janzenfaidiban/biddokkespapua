<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>{{ env('APP_NAME') ?? 'Database GKI Klasis Waibu Moi' }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

        <!-- Plugins css -->
        {{-- <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" /> --}}
        {{-- <link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" /> --}}

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <link href="{{ asset('assets/css/bootstrap-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="{{ asset('assets/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

        <!-- icons -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        @yield('head')
        
        <!-- Loading overlay -->
        <style>
    #loading {
        position: fixed;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8); /* Putih transparan */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .loading-img {
        width: 80px;
        height: 80px;
        animation: floatZoom 2s ease-in-out infinite;
    }

    @keyframes floatZoom {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }
</style>
        

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <!-- font awesome icon cdn -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>

    <body class="loading" data-layout-mode="horizontal" data-layout='{"mode": "{{ Auth::user()->theme }}", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>


    <div id="loading">
        <img src="{{ asset('assets/images/favicon.png') }}" alt="Loading..." class="loading-img" />
    </div>

        <!-- Begin page -->
        <div id="wrapper">

            <x-topbar />

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            @yield('content')

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Vendor js -->
        
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        {{-- <script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/libs/multiselect/js/jquery.multi-select.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/libs/bootstrap-select/js/bootstrap-select.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script> --}}

        <!-- Plugins js-->
        {{-- <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

        {{-- <script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script> --}}

        <!-- Dashboar 1 init js-->
        {{-- <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script> --}}

        <!-- Init js-->
        {{-- <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script> --}}
        
        @stack('scripts')

        <!-- App js-->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

        <script>
            // Simulasikan waktu loading sebelum menampilkan konten utama
            window.addEventListener("load", function () {
                setTimeout(function () {
                    document.getElementById("loading").style.display = "none";
                }, 1000); // Simulasi loading selama 1 detik
            });
        </script>

    </body>
</html>
