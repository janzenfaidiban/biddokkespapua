<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>{{ $siteTitle ?? 'Sistem Informasi' }}</title>

  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

  <link rel="icon" href="{!! $siteFavicon ?? 'favicon.png' !!}" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
  <script>
    WebFont.load({
      google: { families: ["Public Sans:300,400,500,600,700"] },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
</head>

<body>

  <div class="wrapper">

    <x-sidebar />

    <!-- main-panel -->
    <div class="main-panel">

      <x-header />

      <!-- main content -->
      <div class="container">
        <div class="page-inner">

          <x-page-header />

          <div class="page-category">

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab aliquid ut quo at illo nisi molestiae praesentium maiores minus harum atque labore qui itaque in, distinctio non autem rerum soluta repellendus provident eos quae quidem. Magni rem similique perferendis aut dolore. Molestiae dicta iure sed error beatae ducimus voluptatum ut!</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati, unde. Sequi iusto quidem doloribus. Suscipit exercitationem corrupti a animi, ipsum perferendis fugiat dolorem. Similique, facere.</p>
          </div>

        </div>
        <!-- end page-inner -->
      </div>
      <!-- end container -->

      <x-footer />

    </div>
    <!-- end main-panel -->

  </div>
  <!-- end wrapper -->

  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

  <!-- jQuery Scrollbar -->
  <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

  <!-- Chart JS -->
  <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

  <!-- jQuery Sparkline -->
  <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

  <!-- Chart Circle -->
  <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

  <!-- Datatables -->
  <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

  <!-- Bootstrap Notify -->
  <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

  <!-- jQuery Vector Maps -->
  <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

  <!-- Google Maps Plugin -->
  <script src="{{ asset('assets/js/plugin/gmaps/gmaps.js') }}"></script>

  <!-- Sweet Alert -->
  <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

  <!-- Kaiadmin JS -->
  <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

</body>

</html>
