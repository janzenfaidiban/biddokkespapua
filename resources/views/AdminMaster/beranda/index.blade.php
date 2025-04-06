@extends('layouts.app')
@section('content')

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">                        
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Selamat datang, <b class="px-1">{{ Auth::user()->name ?? 'User name' }}!</b>- Anda login sebagai Admin Master.</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{!! $pageTitle !!}</h4>
                        <p>{!! $pageDescription !!}</p>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card-box text-center py-5 border border-info">
                        <p class="h2 text-info"><i class="fe-flag"></i> Total Klasis</p>
                        <p class="display-2 text-dark fw-bold">{{ $totalKlasis }}</p>
                        <a href="{{ route('adminmaster.klasis.index') }}"><i class="fe-maximize-2"></i> Tampilkan Data</a>
                    </div>
                </div> <!-- end col-->
                
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card-box text-center py-5 border border-danger">
                        <p class="h2 text-danger"><i class="fa fa-church"></i> Total Jemaat</p>
                        <p class="display-2 text-dark fw-bold">{{ $totalJemaat }}</p>
                        <a href="{{ route('adminmaster.jemaat.index') }}"><i class="fe-maximize-2"></i> Tampilkan Data</a>
                    </div>
                </div> <!-- end col-->
                
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card-box text-center py-5 border border-warning">
                        <p class="h2 text-warning"><i class="fe-users"></i> Total Keluarga</p>
                        <p class="display-2 text-dark fw-bold">{{ $totalKeluarga }}</p>
                        <a href="#"><i class="fe-maximize-2"></i> Tampilkan Data</a>
                    </div>
                </div> <!-- end col-->
                
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card-box text-center py-5 border border-success">
                        <p class="h2 text-success"><i class="fe-users"></i> Total Anggota Keluarga</p>
                        <p class="display-2 text-dark fw-bold">{{ $totalAnggotaKeluarga }}</p>
                        <a href="#"><i class="fe-maximize-2"></i> Tampilkan Data</a>
                    </div>
                </div> <!-- end col-->

            </div>
            <!-- end row-->
            
        </div> <!-- container -->

    </div> <!-- content -->

    @include('layouts.includes.footer')

</div>

@stop
