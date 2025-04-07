<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Login :: {!! $siteTitle !!}</title>

  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="{!! $siteFavicon ?? 'favicon.png' !!}" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>

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
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css" />
</head>

<body>


  <div class="wrapper pt-5">



    <div class="container">
        <div class="row">
            <div class="col-lg-4 mx-auto">
            


                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">

                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLJFp3zGplyzKvJNcdByTY3KRnM9jql5ptRA&s" alt="logo" class="w-50">
                                <h1 class="h4 text-uppercase">{!! $siteTitle !!}</h1>
                                <p class="text-uppercase">{!! $siteDescription !!}</p>
                            </div>
                        </div>
                        
                        <hr>
                        <div class="text-center">
                            <span id="datetime"></span>
                            <p class="text-muted my-3">Gunakan alamat email dan kata sandi untuk mengakses sistem.</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="emailaddress">📧 Alamat Email</label>
                                <input type="text" id="emailaddress" name="email" class="form-control form-control-lg" placeholder="Alamat email">

                                @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">🔑 Kata Sandi</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Kata Sandi">
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="password-eye" style="cursor: pointer;"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <button class="btn btn-black btn-lg w-100" type="submit"> 
                                    <i class="fas fa-paper-plane me-1"></i> Login
                                </button>
                            </div>

                            <hr>

                            <div class="mt-3">
                                <p class="text-muted">Jika ada kendala saat mengakses, silahkan hubungi tim admin dan ajukan kendala tersebut.</p>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->


            </div>
        </div>
    </div>

    
  </div>
  <!-- end wrapper -->


  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Google Maps Plugin -->
  <script src="assets/js/plugin/gmaps/gmaps.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>
</body>

</html>