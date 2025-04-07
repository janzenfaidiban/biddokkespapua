<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login :: {{ env('APP_NAME') ?? 'Database GKI Klasis Waibu Moi' }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

		<!-- App css -->
		<link href="{{ asset('assets/css/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="{{ asset('assets/css/bootstrap-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="{{ asset('assets/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

		<!-- icons -->
		<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- font awesome icon cdn -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>

    <body class="loading authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">

                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">

                                        <img src="{!! asset('assets/images/favicon.png') !!}" alt="logo" class="w-50">
                                        <h1 class="h4 text-uppercase">{!! env('APP_NAME') !!}</h1>
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
                                        <label for="emailaddress">{!! $iconEmail !!} Alamat Email</label>
                                        <input type="text" id="emailaddress" name="email" class="form-control form-control-lg" placeholder="Alamat email">

                                        @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                         @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">{!! $iconKataSandi !!} Kata Sandi</label>
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
                                        <button class="btn btn-primary btn-lg w-100" type="submit"> 
                                            {!! $iconLogin !!} Login
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

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
            {!! $siteCopyright ?? '' !!}
        </footer>

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>


        <!-- timer di topbar -->
        <script>
            function updateDateTime() {
                const now = new Date();
                const dateOptions = { 
                    weekday: 'long', 
                    day: '2-digit', 
                    month: 'long', 
                    year: 'numeric'
                };
                const timeOptions = {
                    hour: '2-digit', 
                    minute: '2-digit', 
                    second: '2-digit' 
                };
                
                const dateStr = `<i class="fe-calendar mr-1"></i> ${new Intl.DateTimeFormat('id-ID', dateOptions).format(now)}`;
                const timeStr = `<i class="fe-clock mr-1"></i> ${new Intl.DateTimeFormat('id-ID', timeOptions).format(now)}`;
                
                document.getElementById('datetime').innerHTML = `${dateStr} <span class="mx-2">|</span> ${timeStr}`;
            }

            // Update the time every second
            setInterval(updateDateTime, 1000);

            // Initial call to display immediately
            updateDateTime();

        </script>

    </body>
</html>
