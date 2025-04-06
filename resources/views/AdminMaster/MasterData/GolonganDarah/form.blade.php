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
                                <li class="breadcrumb-item text-capitalize">
                                    <a  href="{{ route('adminmaster.beranda') }}">Beranda</a> 
                                </li>
                                <li class="breadcrumb-item text-capitalize active">
                                    {{ $pageTitle }}
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title text-capitalize">{{ $pageTitle }}</h4>
                        <p>{{ $pageDescription }}</p>
                    </div>
                </div>
            </div>
            <!-- end breadcrumb --> 

            {!! display_bootstrap_alerts() !!}

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        
                            @if(Request::segment(4) == 'edit')
                                {!! Form::open(['route' => ['adminmaster.masterdata.golongandarah.update', $data->id], 'method' => 'put', 'files' => true]) !!}
                            @else
                                {!! Form::open(['route' => 'adminmaster.masterdata.golongandarah.store', 'method' => 'post', 'files' => true]) !!}
                            @endif

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="golongandarah"> Pendidikan Terakhir</label>
                                        <input type="text" id="golongandarah" @if(Request::segment(4) == 'detail') disabled @endif  name="golongandarah" class="form-control" value="{{old('golongandarah') ?? $data->golongandarah ?? ''}}">
                                        @if ($errors->has('golongandarah'))
                                            <span class="text-danger" role="alert">
                                                <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{
                                                    $errors->first('golongandarah') }}</small>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" @if(Request::segment(4) == 'detail') disabled @endif name="keterangan" rows="5">{{old('keterangan') ?? $data->keterangan ?? ''}}</textarea>
                                        @if ($errors->has('keterangan'))
                                            <span class="text-danger" role="alert">
                                                <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{
                                                    $errors->first('keterangan') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <!-- form-group end -->
                                     
                                </div><!-- .col end -->
                            </div><!-- .row end -->
                            
                            <hr>

                            <div class="row">
                                <div class="col-12">

                                    <div class="form-group">
                                            @if (Request::segment(4) == 'detail')
                                            <a href="{{ route('adminmaster.masterdata.golongandarah.edit', $data->id) }}" class="btn btn-primary waves-effect waves-light">
                                                <i class="fa fa-edit"></i> Ubah
                                            </a>
                                            @else
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                            @endif
                                            <a href="{{ route('adminmaster.masterdata.golongandarah') }}" class="btn btn-outline-dark waves-effect waves-light">
                                                <i class="fa fa-reply"></i> Kembali
                                            </a>

                                        @if(Request::segment(4) == 'detail')
                                        <small class="text-muted d-block mt-2">Klik tombol "Ubah" untuk menampilkan formulir ubah data</small>
                                        @endif

                                    </div>

                                </div> <!-- end col-->
                            </div>
                            <!-- end row-->
                            {!! Form::close() !!}
                            <!-- end form-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    @include('layouts.includes.footer')

</div>

@stop