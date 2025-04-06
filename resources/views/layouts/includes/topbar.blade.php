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

                    @if(Auth::user()->hasRole('admin'))

                    <!-- item-->
                    <a href="{{route('admin.profil')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Profil</span>
                    </a>

                    @endif

                    @if(Auth::user()->hasRole('operator'))

                    <!-- item-->
                    <a href="{{route('admin.profil')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Profil</span>
                    </a>

                    @endif

                    @if(Auth::user()->hasRole('adminjemaat'))

                    <!-- item-->
                    <a href="{{ route('adminjemaat.profil') }}" class="dropdown-item notify-item">
                        <i class="fa fa-church"></i>
                        <span>Profil Jemaat</span>
                    </a>

                    @endif

                    <div class="dropdown-divider"></div>

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
            <a href="/" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="46">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="46">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
            </a>

            <a href="/" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="46">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="46">
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

                    @if(Auth::user()->hasRole('adminmaster'))

                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(2) == '') text-primary @endif" href="{{ route('adminmaster.beranda') }}">
                            <i class="fe-home mr-1"></i> Beranda
                        </a>
                    </li> <!-- end nav item-->

                    <li class="nav-item @if(Request::segment(2) == 'klasis') active @endif">
                        <a class="nav-link @if(Request::segment(2) == 'klasis') text-primary @endif" href="{{route('adminmaster.klasis.index')}}">
                            <i class="fe-flag mr-1"></i> Klasis
                        </a>
                    </li> <!-- end nav item-->

                    <li class="nav-item @if(Request::segment(2) == 'jemaat') active @endif">
                        <a class="nav-link @if(Request::segment(2) == 'jemaat') text-primary @endif" href="{{route('adminmaster.jemaat.index')}}">
                            <i class="fa fa-church mr-1"></i> Jemaat
                        </a>
                    </li> <!-- end nav item-->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none @if(Request::segment(2) == 'golongandarah' || Request::segment(2) == 'statusbaptis' || Request::segment(2) == 'statussidi' || Request::segment(2) == 'intra' || Request::segment(2) == 'statuspernikahan' || Request::segment(2) == 'hubungankeluarga' || Request::segment(2) == 'gelardepan' || Request::segment(2) == 'gelarbelakang' || Request::segment(2) == 'jenispekerjaan' || Request::segment(2) == 'statusdomisili' || Request::segment(2) == 'penyandangcacat' || Request::segment(2) == 'pendidikanterakhir' || Request::segment(2) == 'suku') text-primary @endif" href="#" id="topnav-apps" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-tag mr-1"></i> Master Data <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">

                            <a href="{{ route('adminmaster.masterdata.golongandarah') }}" class="dropdown-item @if(Request::segment(2) == 'golongandarah') active @endif"><i class="fe-tag mr-1"></i> Golongan Darah</a>
                            <a href="{{ route('adminmaster.masterdata.statusbaptis') }}" class="dropdown-item @if(Request::segment(2) == 'statusbaptis') active @endif"><i class="fe-tag mr-1"></i> Status Baptis</a>
                            <a href="{{ route('adminmaster.masterdata.statussidi') }}" class="dropdown-item @if(Request::segment(2) == 'statussidi') active @endif"><i class="fe-tag mr-1"></i> Status Sidi</a>
                            <a href="{{ route('adminmaster.masterdata.intra') }}" class="dropdown-item @if(Request::segment(2) == 'intra') active @endif"><i class="fe-tag mr-1"></i> Intra</a>
                            <a href="{{ route('adminmaster.masterdata.statuspernikahan') }}" class="dropdown-item @if(Request::segment(2) == 'statuspernikahan') active @endif"><i class="fe-tag mr-1"></i> Status Pernikahan</a>
                            <a href="{{ route('adminmaster.masterdata.hubungankeluarga') }}" class="dropdown-item @if(Request::segment(2) == 'hubungankeluarga') active @endif"><i class="fe-tag mr-1"></i> Hubungan Keluarga</a>
                            <a href="{{ route('adminmaster.masterdata.gelardepan') }}" class="dropdown-item @if(Request::segment(2) == 'gelardepan') active @endif"><i class="fe-tag mr-1"></i> Gelar Depan</a>
                            <a href="{{ route('adminmaster.masterdata.gelarbelakang') }}" class="dropdown-item @if(Request::segment(2) == 'gelarbelakang') active @endif"><i class="fe-tag mr-1"></i> Gelar Belakang</a>
                            <a href="{{ route('adminmaster.masterdata.jenispekerjaan') }}" class="dropdown-item @if(Request::segment(2) == 'jenispekerjaan') active @endif"><i class="fe-tag mr-1"></i> Jenis Pekerjaan</a>
                            <a href="{{ route('adminmaster.masterdata.statusdomisili') }}" class="dropdown-item @if(Request::segment(2) == 'statusdomisili') active @endif"><i class="fe-tag mr-1"></i> Status Domisili</a>
                            <a href="{{ route('adminmaster.masterdata.penyandangcacat') }}" class="dropdown-item @if(Request::segment(2) == 'penyandangcacat') active @endif"><i class="fe-tag mr-1"></i> Penyandang Cacat</a>
                            <a href="{{ route('adminmaster.masterdata.pendidikanterakhir') }}" class="dropdown-item @if(Request::segment(2) == 'pendidikanterakhir') active @endif"><i class="fe-tag mr-1"></i> Pendidikan Terakhir</a>
                            <a href="{{ route('adminmaster.masterdata.suku') }}" class="dropdown-item @if(Request::segment(2) == 'suku') active @endif"><i class="fe-tag mr-1"></i> Suku</a>

                        </div>
                    </li> <!-- end nav item-->
                    
                    @endif












                    
                    
                    @if(Auth::user()->hasRole('adminklasis'))

                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(2) == '') text-primary @endif" href="{{ route('adminklasis.beranda') }}">
                            <i class="fe-home mr-1"></i> Beranda
                        </a>
                    </li> <!-- end nav item-->

                    <li class="nav-item @if(Request::segment(2) == 'jemaat') active @endif">
                        <a class="nav-link @if(Request::segment(2) == 'jemaat') text-primary @endif" href="{{route('adminklasis.jemaat.index')}}">
                            <i class="fa fa-church mr-1"></i> Jemaat
                        </a>
                    </li> <!-- end nav item-->

                    @endif




















                    
                    @if(Auth::user()->hasRole('adminjemaat'))

                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(2) == '') text-primary @endif" href="{{ route('adminjemaat.beranda') }}">
                            <i class="fe-home mr-1"></i> Beranda
                        </a>
                    </li> <!-- end nav item-->

                    <li class="nav-item @if(Request::segment(2) == 'keluarga') active @endif">
                        <a class="nav-link @if(Request::segment(2) == 'keluarga') text-primary @endif" href="{{ route('adminjemaat.keluarga.index') }}">
                            <i class="fe-users mr-1"></i> Keluarga & Anggota Keluarga
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
        
        const dateStr = `<i class="fe-calendar mr-1"></i> ${new Intl.DateTimeFormat('id-ID', dateOptions).format(now)}`;
        const timeStr = `<i class="fe-clock mr-1"></i> ${new Intl.DateTimeFormat('id-ID', timeOptions).format(now)}`;
        
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
