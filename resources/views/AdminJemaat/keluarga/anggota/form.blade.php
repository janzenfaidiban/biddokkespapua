@extends('layouts.app')
@section('content')

<div class="content-page">

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
        
            <!-- start breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item text-capitalize @if (!Request::segment(0)) active @endif">
                                    <a  href="{{ route('adminjemaat.beranda') }}">Beranda</a> 
                                </li>
                                <li class="breadcrumb-item text-capitalize @if (!Request::segment(0)) active @endif">
                                    <a  href="{{ route('adminjemaat.keluarga.index') }}">Keluarga</a> 
                                </li>
                                <li class="breadcrumb-item text-capitalize @if (!Request::segment(0)) active @endif">
                                    <a  href="{{ route('adminjemaat.keluarga.anggota.index', $keluarga->no_kk) }}">Anggota Keluarga</a> 
                                </li>
                                <li class="breadcrumb-item text-capitalize @if (!Request::segment(0)) active @endif">
                                    Tambah
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title text-capitalize">{{ Str::headline(Request::segment(5)) }} Anggota Keluarga</h4>
                    </div>
                </div>
            </div>
            <!-- end breadcrumb -->

            @include('components.alert')


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        
                        @if (Request::segment(5) == 'ubah')
                            {!! Form::open(['route' => ['adminjemaat.keluarga.anggota.update', $anggota->id ], 'method' => 'put', 'files' => true]) !!}
                        @else
                            {!! Form::open(['route' => 'adminjemaat.keluarga.anggota.store', 'method' => 'post', 'files' => true]) !!}
                        @endif

                        <div class="row">

                            <div class="col-lg-6">

                                <!-- Nomor Kepala Keluarga -->
                                <div class="form-group mb-3">
                                    <label for="kelasis"><i class="fa fa-users"></i> Nomor Kartu Keluarga <sup class="text-danger">*</sup></label>
                                    <input type="text" name="kelasis" class="form-control {{ Request::segment(5) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-secondary border-bottom bg-light' }}" value="{{ $keluarga->no_kk ?? '' }}" disabled>

                                    <input type="hidden" name="no_kk" value="{{ $keluarga->no_kk ?? '' }}">
                                </div> <!-- form-group row-->

                                
                                <h5 class="my-3 mt-4 text-uppercase"><i class="fe-user mr-1"></i> Biodata</h5>
                                <hr>


                                
                                <!-- Nama Lengkap -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        
                                        <div class="form-group">
                                            <label for="nama_depan"> Nama Depan <sup class="text-danger">*</sup></label>
                                            <input type="text" name="nama_depan" class="form-control {{ $errors->has('nama_depan') ? 'is-invalid' : '' }} {{ Request::segment(5) == 'detail' ? 'border-secondary border-bottom bg-light' : '' }}" value="{{ old('nama_depan', isset($anggota) ? $anggota->nama_depan : '') }}" {{ Request::segment(5) == 'detail' ? 'disabled' : '' }}>


                                            @if ($errors->has('nama_depan'))
                                                <span class="text-danger" role="alert">
                                                    <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $errors->first('nama_depan') }}</small>
                                                </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        
                                        <div class="form-group3">
                                            <label for="nama_tengah"> Nama Tengah</label>
                                            <input type="text" name="nama_tengah" class="form-control {{ Request::segment(5) == 'detail' ? 'border-secondary border-bottom bg-light' : '' }}" value="{{ old('nama_tengah', isset($anggota) ? $anggota->nama_tengah : '') }}"  {{ Request::segment(5) == 'detail' ? 'disabled' : '' }}>
                                        </div> <!-- form-group row-->

                                    </div>
                                    <div class="col-lg-4">
                                        
                                        <div class="form-group">
                                            <label for="nama_belakang"> Nama Belakang</label>
                                            <input type="text" name="nama_belakang" class="form-control {{ Request::segment(5) == 'detail' ? 'border-secondary border-bottom bg-light' : '' }}" value="{{ old('nama_belakang', isset($anggota) ? $anggota->nama_belakang : '') }}"  {{ Request::segment(5) == 'detail' ? 'disabled' : '' }}>
                                        </div> <!-- form-group row-->

                                    </div>
                                </div> <!-- form-group row-->

                                <!-- tempat, tanggal lahir -->

                                <div class="row">
                                    <div class="col-lg-4">
                                        
                                        @include('AdminJemaat.keluarga.anggota.inputs.tempatlahir')

                                    </div>
                                    <div class="col-lg-4">
                                        
                                        @include('AdminJemaat.keluarga.anggota.inputs.tanggallahir')

                                    </div>
                                </div> <!-- form-group row-->
                                

                                
                                
                                @include('AdminJemaat.keluarga.anggota.inputs.jeniskelamin')
                                @include('AdminJemaat.keluarga.anggota.inputs.hubungankeluarga')
                                
                                <h5 class="my-3 mt-4 text-uppercase"><i class="fa fa-church mr-1"></i> Informasi Jemaat</h5>
                                <hr>

                                @include('AdminJemaat.keluarga.anggota.inputs.intra')

                                @include('AdminJemaat.keluarga.anggota.inputs.statusbaptis')
                                @include('AdminJemaat.keluarga.anggota.inputs.statussidi')
                                @include('AdminJemaat.keluarga.anggota.inputs.statuspernikahan')
                                
                                <h5 class="my-3 mt-4 text-uppercase"><i class="fe-phone mr-1"></i> Informasi Kontak</h5>
                                <hr>

                                @include('AdminJemaat.keluarga.anggota.inputs.nomorhp')
                                @include('AdminJemaat.keluarga.anggota.inputs.email')
                                
                                <h5 class="my-3 mt-4 text-uppercase"><i class="fe-tag mr-1"></i> Informasi Lainnya</h5>
                                <hr>

                                @include('AdminJemaat.keluarga.anggota.inputs.suku')
                                @include('AdminJemaat.keluarga.anggota.inputs.statusdomisili')

                                @include('AdminJemaat.keluarga.anggota.inputs.pendidikanterakhir')
                                @include('AdminJemaat.keluarga.anggota.inputs.golongandarah')
                                @include('AdminJemaat.keluarga.anggota.inputs.gelardepan')
                                @include('AdminJemaat.keluarga.anggota.inputs.gelarbelakang')
                                @include('AdminJemaat.keluarga.anggota.inputs.jenispekerjaan')
                                @include('AdminJemaat.keluarga.anggota.inputs.penyandangcacat')






                            </div> <!-- end col-->
                            
                            <div class="col-12">
                            
                                <hr>

                                <div class="form-group mb-3">
                                    <div class="form-group mb-3">
                                        @if (Request::segment(5) == 'detail')
                                        <a href="{{ route('adminjemaat.keluarga.anggota.edit', $anggota->id ) }}" class="btn btn-primary waves-effect waves-light">
                                            {!! $iconTombolUbah ?? '' !!} Ubah
                                        </a>
                                        @else
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            {!! $iconTombolSimpan ?? '' !!} Simpan
                                        </button>
                                        @endif
                                        <a href="{{ route('adminjemaat.keluarga.anggota.index', $keluarga->no_kk ) }}" class="btn waves-effect waves-light">
                                            {!! $iconTombolKembali ?? '' !!} Kembali
                                        </a>

                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- end row-->

                        {!! Form::close() !!}
                        <!-- end form-->

                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    @include('layouts.includes.footer')

</div>

@stop
