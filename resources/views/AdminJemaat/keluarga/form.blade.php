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
                                    Keluarga
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title text-capitalize">Anggota Keluarga</h4>
                    </div>
                </div>
            </div>
            <!-- end breadcrumb --> 

            @include('components.alert')

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        
                        @if(Request::segment(4) == 'ubah')
                            {!! Form::open(['route' => ['adminjemaat.keluarga.update', Request::segment(3)], 'method' => 'put', 'files' => true]) !!}
                        @else
                            {!! Form::open(['route' => 'adminjemaat.keluarga.store', 'method' => 'post', 'files' => true]) !!}
                        @endif

                        <div class="row">

                            <div class="col-12">

                                <!-- Klasis -->
                                <div class="form-group mb-3">
                                    <label for="kelasis"><i class="fa fa-building"></i> Klasis <sup class="text-danger">*</sup></label>
                                    <input type="text" name="kelasis" class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-secondary border-bottom bg-light' }}" disabled value="{{ $jemaat->klasis->nama_klasis ?? $jemaat->klasis->nama_klasis }}" >
                                </div> <!-- form-group row-->

                                <!-- Jemaat -->
                                <div class="form-group mb-3">
                                    <label for="jemaat"><i class="fa fa-church"></i> Jemaat <sup class="text-danger">*</sup></label>
                                    <input type="text" name="jemaat" class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-secondary border-bottom bg-light' }}" disabled value="{{ $jemaat->nama_jemaat ?? $jemaat->nama_jemaat }}" >
                                </div> <!-- form-group row-->

                                <!-- no kk, dibuat otomatis oleh sistem  -->
                                <div class="form-group mb-3">
                                    <label for="no_kk"><i class="fa fa-user"></i> Nomor Kepala Keluarga <sup class="text-danger">*</sup></label>
                                    <input type="text" name="no_kk" 
                                        class="form-control {{ $errors->has('no_kk') ? 'border-danger' : (Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-primary') }}" 
                                        placeholder="" 
                                        value="{{ $newNoKk ?? $item->no_kk }}" >
                                    <input type="text" hidden name="jemaat_id" value="{{ $jemaat->id ?? '' }}">

                                    @if ($errors->has('no_kk'))
                                        <span class="text-danger" role="alert">
                                            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $errors->first('no_kk') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <!-- form-group row-->

                                <!-- keterangan -->
                                <div class="form-group mb-3">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-primary' }}" id="keterangan" name="keterangan" rows="5" @if(Request::segment(4) == 'detail') disabled @endif>@if(Request::segment(4) == 'tambah') Kartu keluarga baru di Jemaat {{ $jemaat->nama_jemaat ?? '' }}, klasis {{ $jemaat->klasis->nama_klasis ?? '' }} @else{{ $item->keterangan ?? '' }} @endif </textarea>
                                    
                                    @if ($errors->has('keterangan'))
                                        <span class="text-danger" role="alert">
                                            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $errors->first('keterangan') }}</small>
                                        </span>
                                    @endif

                                </div> <!-- form-group row-->



                            </div> <!-- end col-->
                            
                            <div class="col-12">
                                <hr>


                                <div class="form-group mb-3">
                                    <div class="form-group mb-3">
                                        @if (Request::segment(4) == 'detail')
                                        <a href="{{route('adminjemaat.keluarga.edit', Request::segment(3)) . '?jemaat_id=' . $jemaat->id ?? $jemaat->id}}" class="btn btn-primary waves-effect waves-light">
                                            {!! $iconTombolUbah ?? '' !!} Ubah
                                        </a>
                                        @else
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            {!! $iconTombolSimpan ?? '' !!} Simpan
                                        </button>
                                        @endif
                                        <a href="{{ route('adminjemaat.keluarga.index') }}" class="btn waves-effect waves-light">
                                            {!! $iconTombolKembali ?? '' !!} Kembali
                                        </a>
                                    </div>

                                </div>

                            </div> <!-- end col-->
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
