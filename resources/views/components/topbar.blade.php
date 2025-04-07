<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset(Auth::user()->avatar ) ?? 'no-image.png'}}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        {{ Auth::user()->name ?? 'User Name' }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">
                            Selamat datang, {{ Auth::user()->name ?? 'User name' }}!</b> 
                            <p><i class="fe-mail"></i> {!! Auth::user()->email !!}</p>
                        </h6>
                    </div>

                    <!-- item-->
                    <a class="dropdown-item notify-item">

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input theme-radio" name="color-scheme-mode" value="light" id="light-mode-check" {{ Auth::user()->theme == 'light' ? 'checked' : '' }} />
                            <label class="custom-control-label" for="light-mode-check" style="cursor: pointer;">Mode Terang</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input theme-radio" name="color-scheme-mode" value="dark" id="dark-mode-check" {{ Auth::user()->theme == 'dark' ? 'checked' : '' }} />
                            <label class="custom-control-label" for="dark-mode-check" style="cursor: pointer;">Mode Gelap</label>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="#" class="dropdown-item notify-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fe-log-out"></i>
                        <span> {{ __('Keluar') }}</span>
                    </a>

                    <!-- item-->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            @if(Auth::user()->hasRole('admin'))
            <a href="{{ route('admin.dasbor') }}" class="logo logo-dark text-center"> @endif
            @if(Auth::user()->hasRole('operator'))
            <a href="{{ route('operator.dasbor') }}" class="logo logo-dark text-center"> @endif
                <span class="logo-sm">
                    <!-- <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="46"> -->
                    <img src="{!! asset('assets/images/favicon.png') !!}" alt="logo" height="46">
                    <span class="logo-lg-text-light">UBold</span>
                </span>
                <span class="logo-lg">
                    <!-- <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="46"> -->
                    <img src="{!! asset('assets/images/favicon.png') !!}" alt="logo" height="46">
                    <span class="logo-lg-text-light">{!! env('APP_NAME') !!}</span>
                </span>
            </a>

            @if(Auth::user()->hasRole('admin'))
            <a href="{{ route('admin.dasbor') }}" class="logo logo-light text-center"> @endif
            @if(Auth::user()->hasRole('operator'))
            <a href="{{ route('operator.dasbor') }}" class="logo logo-light text-center"> @endif
                <span class="logo-sm">
                    <!-- <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="46"> -->
                    <img src="{!! asset('assets/images/favicon.png') !!}" alt="logo" height="46">
                </span>
                <span class="logo-lg">
                    <!-- <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="46"> -->
                    <img src="{!! asset('assets/images/favicon.png') !!}" alt="logo" height="46">
                    <span class="logo-lg-text-light">{!! env('APP_NAME') !!}</span>
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

            <li class="d-none d-xl-block">
                <a class="nav-link waves-effect waves-light" style="pointer-events: none;">
                    <span id="datetime"></span>
                </a>
            </li>

        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->

<div class="topnav shadow-lg">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    @if(Auth::user()->hasRole('admin'))

                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(2) == '' || Request::segment(2) == 'dasbor') text-primary @endif" href="{{ route('admin.dasbor') }}">
                            <i class="fe-home"></i> Dasbor
                        </a>
                    </li> <!-- end nav item-->

                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(2) == 'poliklinik') text-primary @endif" href="{{ route('admin.poliklinik.index') }}">
                            <i class="fe-layers"></i> Poliklinik 
                        </a>
                    </li> <!-- end nav item-->

                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(2) == 'barang') text-primary @endif" href="{{ route('admin.barang.index') }}">
                            <i class="fe-box"></i> Barang
                        </a>
                    </li> <!-- end nav item-->

                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(2) == 'barangmasuk') text-primary @endif" href="{{ route('admin.barangmasuk.index') }}">
                            <i class="fe-log-in"></i> Barang Masuk
                        </a>
                    </li> <!-- end nav item-->

                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(2) == 'barangkeluar') text-primary @endif" href="{{ route('admin.barangkeluar.index') }}">
                            <i class="fe-log-out"></i> Barang Keluar
                        </a>
                    </li> <!-- end nav item-->

                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(2) == 'usulanbarang') text-primary @endif" href="{{ route('admin.usulanbarang.index') }}">
                            <i class="fe-navigation"></i> Usulan Barang dari Poliklinik <sup class="text-primary">(10 baru masuk)</sup>
                        </a>
                    </li> <!-- end nav item-->
                    
                    @endif












                    
                    
                    @if(Auth::user()->hasRole('opertaor'))

                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(2) == '') text-primary @endif" href="{{ route('adminklasis.beranda') }}">
                            <i class="fe-home"></i> item
                        </a>
                    </li> <!-- end nav item-->

                    <li class="nav-item @if(Request::segment(2) == 'jemaat') active @endif">
                        <a class="nav-link @if(Request::segment(2) == 'jemaat') text-primary @endif" href="{{route('adminklasis.jemaat.index')}}">
                            <i class="fa fa-church"></i> item
                        </a>
                    </li> <!-- end nav item-->

                    @endif


                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div> <!-- end topnav-->


@push('scripts')


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
        
        const dateStr = `<i class="fe-calendar"></i> ${new Intl.DateTimeFormat('id-ID', dateOptions).format(now)}`;
        const timeStr = `<i class="fe-clock"></i> ${new Intl.DateTimeFormat('id-ID', timeOptions).format(now)}`;
        
        document.getElementById('datetime').innerHTML = `${dateStr} <span class="mx-2">|</span> ${timeStr}`;
    }

    // Update the time every second
    setInterval(updateDateTime, 1000);

    // Initial call to display immediately
    updateDateTime();

</script>

<!-- fungsi modal hapus -->
<script>
    function confirmDelete(url) {
        $('#deleteForm').attr('action', url);
        $('#deleteModal').modal('show');
    }
</script>

<!-- jQuery (Ensure it's included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('.theme-radio').on('change', function() {
        let selectedTheme = $(this).val();

        $.ajax({
            url: "{{ route('update.theme') }}",
            type: "POST",
            data: {
                theme: selectedTheme,
                _token: "{{ csrf_token() }}"
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert("An error occurred.");
            }
        });
    });
});
</script>

@endpush
