@if (Auth::user()->hasRole('adminmaster'))

<div class="row">
                
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                        <i class="fe-users font-22 avatar-title text-primary"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup">34</span></h3>
                        <p class="text-muted mb-1 text-truncate">Klasis</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                        <i class="fe-home font-22 avatar-title text-warning"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup">12</span></h3>
                        <p class="text-muted mb-1 text-truncate">Jemaat</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                        <i class="fe-home font-22 avatar-title text-danger"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup">123</span></h3>
                        <p class="text-muted mb-1 text-truncate">Kartu Keluarga</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                        <i class="fe-home font-22 avatar-title text-success"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup">1234</span></h3>
                        <p class="text-muted mb-1 text-truncate">Anggota Keluarga</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

</div>
<!-- end row-->

@elseif (Auth::user()->hasRole('adminklasis'))

<div class="row">

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                        <i class="fe-home font-22 avatar-title text-warning"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup">12</span></h3>
                        <p class="text-muted mb-1 text-truncate">Jemaat</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                        <i class="fe-home font-22 avatar-title text-danger"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup">123</span></h3>
                        <p class="text-muted mb-1 text-truncate">Kartu Keluarga</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                        <i class="fe-home font-22 avatar-title text-success"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup">1234</span></h3>
                        <p class="text-muted mb-1 text-truncate">Anggota Keluarga</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

</div>
<!-- end row-->

@elseif (Auth::user()->hasRole('adminjemaat'))


<div class="row">
                
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                        <i class="fe-home font-22 avatar-title text-danger"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1 display-1"><span data-plugin="counterup">{{ $totalKeluarga }}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Keluarga</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                        <i class="fe-users font-22 avatar-title text-success"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1 display-1"><span data-plugin="counterup">{{ $totalAnggotaKeluarga }}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Anggota Keluarga</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

</div>
<!-- end row-->

@endif



