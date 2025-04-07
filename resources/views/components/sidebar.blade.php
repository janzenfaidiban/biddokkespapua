<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="{{ route('admin.dasbor') }}" class="logo">
        <img src="{!! $siteLogo ?? '' !!}" alt="navbar brand" class="navbar-brand" height="20" />
        <span class="text-light ps-2">{!! $siteTitle ?? 'site title' !!}</span>
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">




        <li class="nav-item active">
          <a data-bs-toggle="collapse" href="#dasbor" class="collapsed" aria-expanded="false">
            <i class="fas fa-home"></i>
            <p>Dasbor</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="dasbor">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Dasbor</span>
                </a>
              </li>
            </ul>
          </div>
        </li>





        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Rekapan & Laporan</h4>
        </li>


      

        <!-- Ringkasan Statistik -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#ringkasan-statistik" class="collapsed" aria-expanded="false">
            <i class="fas fa-users"></i>
            <p>Ringkasan Statistik</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="ringkasan-statistik">
            <ul class="nav nav-collapse">
              
              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Statistik Fakultas dan Program Studi</span>
                </a>
              </li>
              
              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Ringkasan Statistik</span>
                </a>
              </li>

            </ul>
          </div>
        </li>


      

        <!-- rekapan -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#rekapan" class="collapsed" aria-expanded="false">
            <i class="fas fa-users"></i>
            <p>Rekapan Data</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="rekapan">
            <ul class="nav nav-collapse">
              
              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Anggota Aktif</span>
                </a>
              </li>
              
              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Anggota Pindah Masuk</span>
                </a>
              </li>
              
              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Anggota Pindah Keluar</span>
                </a>
              </li>

              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Alumni Berdasarkan Kampus</span>
                </a>
              </li>

              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Alumni Berdasarkan Kampus</span>
                </a>
              </li>

            </ul>
          </div>
        </li>




        
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Manajemen Data</h4>
        </li>


      

        <!-- anggota -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#anggota" class="collapsed" aria-expanded="false">
            <i class="fas fa-users"></i>
            <p>Anggota</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="anggota">
            <ul class="nav nav-collapse">
              
              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Semua Anggota</span>
                </a>
              </li>

              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Anggota Baru</span>
                </a>
              </li>

              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Pindah Masuk</span>
                </a>
              </li>

              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Pindah Keluar</span>
                </a>
              </li>

            </ul>
          </div>
        </li>


      

        <!-- data master -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#data-master" class="collapsed" aria-expanded="false">
            <i class="fas fa-users"></i>
            <p>Data Master</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="data-master">
            <ul class="nav nav-collapse">
              
              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Kampus</span>
                </a>
              </li>

              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Fakultas</span>
                </a>
              </li>

              <li>
                <a href="{{ route('admin.dasbor') }}">
                  <span class="sub-item">Program Studi</span>
                </a>
              </li>

            </ul>
          </div>
        </li>



           
            
      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->