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
                                    <a  href="{{ route('adminklasis.beranda') }}">Beranda</a> 
                                </li>
                                <li class="breadcrumb-item text-capitalize @if (!Request::segment(0)) active @endif">
                                    <a  href="{{ route('adminklasis.jemaat.index') }}">jemaat</a> 
                                </li>
                                <li class="breadcrumb-item text-capitalize @if (!Request::segment(0)) active @endif">
                                    {!! $pageTitle !!}
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title text-capitalize">{!! $pageTitle !!}</h4>
                        <p>{!! $pageDescription !!}</p>
                    </div>
                </div>
            </div>
            <!-- end breadcrumb --> 
             
            {!! display_bootstrap_alerts() !!}

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @if (Request::segment(4) == 'edit')
                                {!! Form::open(['route' => ['adminklasis.jemaat.update', $data->user->id], 'method' => 'put', 'files' => true]) !!}
                            @else
                                {!! Form::open(['route' => 'adminklasis.jemaat.store', 'method' => 'post', 'files' => true]) !!}
                            @endif
                            @csrf

                            <div class="row">

                                <div class="col-lg-6">

                                    <!-- informasi umum jemaat -->
                                    <h5 class="mb-2 text-uppercase text-primary h4">
                                        <i class="fa fa-church mr-1"></i> Informasi Umum Jemaat
                                    </h5>
                                    <hr>
                                    
                                    <!-- Klasis -->
                                    <div class="form-group">
                                        <label for="klasis">Klasis <sup class="text-danger">*</sup></label>

                                        @if(Request::segment(4) == 'detail')
                                            <!-- Mode detail: Tampilkan teks tanpa dropdown -->
                                            <input type="text" class="form-control border-secondary border-bottom bg-light" 
                                                value="{{ $data->klasis->nama_klasis ?? '-' }}" disabled>
                                        @else
                                            <!-- Mode tambah dan edit: Dropdown -->
                                            <select class="form-control {{ $errors->has('klasis_id') ? 'is-invalid border-danger' : '' }}" id="klasis" name="klasis_id">
                                                <option value="" disabled hidden {{ old('klasis_id', $data->klasis_id ?? '') == '' ? 'selected' : '' }}>Pilih klasis</option>
                                                @foreach($klasis as $item)
                                                    <option value="{{ $item->id }}" {{ old('klasis_id', $data->klasis_id ?? '') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_klasis }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @error('klasis_id')
                                            <span class="text-danger" role="alert">
                                                <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div> <!-- form-group row-->


                                    <!-- Nama Jemaat -->
                                    <div class="form-group mb-3">
                                        <label for="nama_jemaat">Nama Jemaat <sup class="text-danger">*</sup></label>
                                        <input type="text" id="nama_jemaat" name="nama_jemaat" 
                                            class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-primary' }}" 
                                            value="{{ old('nama_jemaat', ($data->nama_jemaat ?? '')) }}" 
                                            @if(Request::segment(4) == 'detail') disabled @endif>

                                        @if ($errors->has('nama_jemaat'))
                                            <span class="text-danger" role="alert">
                                                <small class="pt-1 d-block">
                                                    <i class="fe-alert-triangle mr-1"></i> {{ $errors->first('nama_jemaat') }}
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
                                    
                                    @include('AdminKlasis.jemaat.fileInputs.fotoGereja')

                                    


                                    <!-- Nama Pendeta -->
                                    <div class="form-group mb-3">
                                        <label for="namaPendeta">Nama Pendeta</label>
                                        <input type="text" id="namaPendeta" name="namaPendeta" 
                                            class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-primary' }}" 
                                            value="{{ old('namaPendeta', ($data->user->namaPendeta ?? '')) }}" 
                                            @if(Request::segment(4) == 'detail') disabled @endif>

                                        @if ($errors->has('namaPendeta'))
                                            <span class="text-danger" role="alert">
                                                <small class="pt-1 d-block">
                                                    <i class="fe-alert-triangle mr-1"></i> {{ $errors->first('namaPendeta') }}
                                                </small>
                                            </span>
                                        @endif
                                    </div>
                                    @include('AdminKlasis.jemaat.fileInputs.fotoPendeta')
                                    
                                    @include('AdminKlasis.jemaat.fileInputs.fileStrukturOrganisasi')
                                    @include('AdminKlasis.jemaat.fileInputs.fileSaranaPrasarana')

                                </div> <!-- end col-->
                                <div class="col-lg-6">
                                    
                                
                                
                                    <!-- informasi media sosial jemaat -->
                                    <h5 class="mb-2 text-uppercase text-primary h4">
                                        <i class="fe-globe mr-1"></i> Informasi Media Sosial Jemaat
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
                                    <p class="bg-dark rounded p-3"><i class="fe-info mr-1"></i>  Informasi ini akan digunakan oleh pengguna dari tingkat jemaat untuk mengakses database di tingkat jemaat. Jika "Admin jemaat" operator databasei di tingkat jemaat kehilangan/lupa hak akses ini (email / password), maka "Admin Master" atau pihak developer akan menggantinya di sini. Kemudian diberikan kembali ke admin di tingkat jemaat.</p>

                                    <!-- Alamat Email -->
                                    <div class="mb-3">
                                        <label for="email">Alamat Email <span class="text-danger">*</span> </label>
                                        <input type="email" id="email" name="email" class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : 'border-primary' }}" 
                                            value="{{ old('email', $data->user->email ?? '') }}" placeholder="Alamat Email"
                                            @if(Request::segment(4) == 'detail') disabled @endif>

                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div> <!-- end input group--><!-- Password -->
                                    <div class="mb-3">
                                        <label for="password">Password</label>
                                        
                                        @if(Request::segment(4) == 'detail')
                                            <!-- Jika dalam mode detail, tampilkan teks (bukan input) -->
                                            <input type="text" class="form-control border-secondary border-bottom bg-light" value="********" disabled>
                                        @else
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Isi jika ingin mengganti password">
                                            <small class="text-muted d-block mt-1">
                                                Kosongkan jika tidak ingin mengubah password
                                            </small>
                                        @endif

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
                                        <a href="{{route('adminklasis.jemaat.edit', $data->id)}}" class="btn btn-primary waves-effect waves-light">
                                            {!! $iconTombolUbah !!} Ubah
                                        </a>
                                        @else
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            {!! $iconTombolSimpan !!} Simpan
                                        </button>
                                        @endif
                                        <a href="{{ route('adminklasis.jemaat.index') }}" class="btn waves-effect waves-light">
                                            {!! $iconTombolKembali !!} Kembali
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
                                @include('AdminKlasis.jemaat.modals.delete_foto_gereja_modal')
                                @include('AdminKlasis.jemaat.modals.delete_foto_pendeta_modal')
                                @include('AdminKlasis.jemaat.modals.deleteFileStrukturOrganisasiModal')
                                @include('AdminKlasis.jemaat.modals.deleteFileSaranaPrasaranaModal')    
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

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
