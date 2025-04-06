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
                                    <a  href="{{ route('adminmaster.beranda') }}">Beranda</a> 
                                </li>
                                <li class="breadcrumb-item text-capitalize @if (!Request::segment(0)) active @endif">
                                    <a  href="{{ route('adminmaster.klasis.index') }}">Klasis</a> 
                                </li>
                                <li class="breadcrumb-item text-capitalize @if (!Request::segment(0)) active @endif">
                                    {!! $pageTitle !!}
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title text-capitalize">{!! $pageTitle !!}</h4>
                    </div>
                </div>
            </div>
            <!-- end breadcrumb --> 
                
            @include('components.alert')
             
             {!! display_bootstrap_alerts() !!}

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @if (Request::segment(4) == 'edit')
                                {!! Form::open(['route' => ['adminmaster.klasis.update', $data->user->id], 'method' => 'put', 'files' => true]) !!}
                            @else
                                {!! Form::open(['route' => 'adminmaster.klasis.store', 'method' => 'post', 'files' => true]) !!}
                            @endif
                            @csrf

                            <div class="row">

                                <div class="col-lg-6">

                                    <!-- informasi umum klasis -->
                                    <h5 class="mb-2 text-uppercase text-primary h4">
                                        <i class="fa fa-church mr-1"></i> Informasi Umum Klasis
                                    </h5>
                                    <hr>


                                    <!-- wilayah -->
                                    <div class="form-group">
                                        <label for="wilayah">Wilayah <sup class="text-danger">*</sup></label>
                                        <select class="form-control {{ $errors->has('wilayah_id') ? 'is-invalid border-danger' : '' }}" id="wilayah" name="wilayah_id">
                                            <option value="" disabled hidden {{ old('wilayah_id') == '' ? 'selected' : '' }}>Pilih wilayah</option>
                                            @foreach($wilayah as $item)
                                            <option value="{{ $item->id }}" {{ old('wilayah_id', $item->id ?? '') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->wilayah }}
                                            </option>
                                            @endforeach

                                        </select>
                                        @error('wilayah_id')
                                            <span class="text-danger" role="alert">
                                                <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div> <!-- form-group row-->




                                    <!-- Nama Klasis -->
                                    <div class="form-group mb-3">
                                        <label for="nama_klasis">Nama Klasis <sup class="text-danger">*</sup></label>
                                        <input type="text" id="nama_klasis" name="nama_klasis" 
                                            class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-primary' }}" 
                                            value="{{ old('nama_klasis', ($data->nama_klasis ?? '')) }}" 
                                            @if(Request::segment(4) == 'detail') disabled @endif>

                                        @if ($errors->has('nama_klasis'))
                                            <span class="text-danger" role="alert">
                                                <small class="pt-1 d-block">
                                                    <i class="fe-alert-triangle mr-1"></i> {{ $errors->first('nama_klasis') }}
                                                </small>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Profil -->
                                    <div class="form-group mb-3">
                                        <label for="profil">Profil</label>
                                        <textarea class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-primary' }}" id="profil" name="profil" rows="5" 
                                            @if(Request::segment(4) == 'detail') disabled @endif>{{ old('profil', $data->user->profil ?? '') }}</textarea>

                                        @if ($errors->has('profil'))
                                            <span class="text-danger" role="alert">
                                                <small class="pt-1 d-block">
                                                    <i class="fe-alert-triangle mr-1"></i> {{ $errors->first('profil') }}
                                                </small>
                                            </span>
                                        @endif
                                    </div>



                                    
                                    @include('AdminMaster.klasis.fileInputs.fotoKantor')
                                    @include('AdminMaster.klasis.fileInputs.fotoKetuaKlasis')

                                    @include('AdminMaster.klasis.fileInputs.fileStrukturOrganisasi')
                                    @include('AdminMaster.klasis.fileInputs.fileSaranaPrasarana')
                                
                                </div> <!-- end col-->
                                <div class="col-lg-6">
                                    
                                
                                
                                    <!-- informasi media sosial jemaat -->
                                    <h5 class="mb-2 text-uppercase text-primary h4">
                                        <i class="fe-globe mr-1"></i> Informasi Media Sosial Klasis
                                    </h5>
                                    <hr>

                                    <!-- Instagram -->
                                    <div class="mb-3">
                                        <label for="instagramInput">Instagram</label>
                                        <input type="text" id="instagramInput" name="instagram" class="form-control" 
                                            value="{{ old('instagram', $data->user->instagram ?? '') }}" placeholder="Alamat URL Instagram">
                                        <div class="mt-1">
                                            <p class="text-muted">Contoh: {!! $linkContohInstagram !!}</p>
                                        </div>
                                    </div> <!-- end input group-->

                                    <!-- Facebook -->
                                    <div class="mb-3">
                                        <label for="facebookInput">Facebook</label>
                                        <input type="text" id="facebookInput" name="facebook" class="form-control" 
                                            value="{{ old('facebook', $data->user->facebook ?? '') }}" placeholder="Alamat URL Facebook">
                                        <div class="mt-1">
                                            <p class="text-muted">Contoh: {!! $linkContohFacebook !!}</p>
                                        </div>
                                    </div> <!-- end input group-->

                                    <!-- WA Channel -->
                                    <div class="mb-3">
                                        <label for="wa_channel">WA Channel</label>
                                        <input type="text" id="wa_channel" name="wa_channel" class="form-control" 
                                            value="{{ old('wa_channel', $data->user->wa_channel ?? '') }}" placeholder="Alamat URL WA Channel">
                                        <div class="mt-1">
                                            <p class="text-muted">Contoh: {!! $linkContohWaChannel !!}</p>
                                        </div>
                                    </div> <!-- end input group-->

                                    <!-- YouTube -->
                                    <div class="mb-3">
                                        <label for="youtubeInput">YouTube</label>
                                        <input type="text" id="youtubeInput" name="youtube" class="form-control" 
                                            value="{{ old('youtube', $data->user->youtube ?? '') }}" placeholder="Alamat URL YouTube">
                                        <div class="mt-1">
                                            <p class="text-muted">Contoh: {!! $linkContohYoutube !!}</p>
                                        </div>
                                    </div> <!-- end input group-->







                                    

                                    <!-- informasi hak askses -->
                                    <h5 class="mb-2 text-uppercase text-primary h4">
                                        <i class="fe-lock mr-1"></i> Informasi Hak Akses
                                    </h5>
                                    <hr>
                                    <p class="bg-dark rounded p-3"><i class="fe-info mr-1"></i>  Informasi ini akan digunakan oleh pengguna dari tingkat klasis untuk mengakses database di tingkat klasis. Jika "Admin klasis" operator databasei di tingkat klasis kehilangan/lupa hak akses ini (email / password), maka "Admin Master" atau pihak developer akan menggantinya di sini. Kemudian diberikan kembali ke admin di tingkat klasis.</p>




                                    <!-- Alamat Email -->
                                    <div class="mb-3">
                                        <label for="email">Alamat Email</label>
                                        <input type="text" id="email" name="email" class="form-control" value="{{ old('email', $data->user->email ?? '') }}" placeholder="Alamat Email">
                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div> <!-- end input group-->

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                        <!-- <small class="text-muted d-block mt-1">
                                            Tulis password baru jika ingin mengganti password
                                        </small> -->
                                        @error('password')
                                            <span class="text-danger" role="alert">
                                                <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div> <!-- end input group-->


                                </div> <!-- end col-->

                            </div> <!-- end row-->

                            <div class="row">
                                <div class="col">

                                    <hr>

                                    <div class="form-group mb-3">
                                        @if (Request::segment(4) == 'detail')
                                        <a href="{{route('adminmaster.klasis.edit', $data->id)}}" class="btn btn-primary waves-effect waves-light">
                                            {!! $iconTombolUbah ?? '' !!} Ubah
                                        </a>
                                        @else
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            {!! $iconTombolSimpan ?? '' !!} Simpan
                                        </button>
                                        @endif
                                        <a href="{{ route('adminmaster.klasis.index') }}" class="btn waves-effect waves-light">
                                            {!! $iconTombolKembali ?? '' !!} Kembali
                                        </a>
                                    </div>
                                    <!-- end form-group -->

                                </div>
                                <!-- end col-->
                            </div>
                            <!-- end row-->

                            {!! Form::close() !!}
                            <!-- end form-->

                            <!-- Include Modals -->
                            @if(Request::segment(3) != 'create' && Request::segment(4) == 'edit')
                                @include('AdminMaster.klasis.modals.deleteFotoKantorModal')
                                @include('AdminMaster.klasis.modals.deleteFotoKetuaKlasisModal')
                                @include('AdminMaster.klasis.modals.deleteFileStrukturOrganisasiModal')
                                @include('AdminMaster.klasis.modals.deleteFileSaranaPrasaranaModal')    
                            @endif

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
