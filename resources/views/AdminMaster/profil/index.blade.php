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
                                        {!! $pageTitle ?? '' !!}
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title text-capitalize">{!! $pageTitle ?? '' !!}</h4>
                            <p>{!! $pageDescription ?? '' !!}</p>
                        </div>
                    </div>
                </div>
                <!-- end breadcrumb -->
                 
                @include('components.alert')

                <div class="row">
                    <div class="col-lg-4 col-xl-4">
                        <div class="card-box">
                            
                            <div class="text-center">
                                <img src="{{ asset($data->avatar) }}" class="rounded avatar-lg img-thumbnail" alt="profile-image">

                                <h4 class="mb-0">{{ $data->name ?? '' }}</h4>

                                <p class="text-muted">{{ $data->email ?? '' }}</p>
                            </div>

                            <div class="mt-3">
                                @if(!Auth::user()->hasRole('adminmaster|sinode|adminwilayah'))

                                    @if(Auth::user()->hasRole('adminklasis|adminklasis'))
                                        <p class="text-muted mb-2 font-13"><i class="fe-flag mr-1"></i> <strong>Wilayah :</strong> <span class="ml-2">{{ $wilayah ?? '' }}</span></p>
                                    @endif

                                    @if(Auth::user()->hasRole('adminklasis'))
                                        <p class="text-muted mb-2 font-13"><i class="fe-map mr-1"></i> <strong>Klasis :</strong> <span class="ml-2">{{ $klasis->nama_klasis ?? '' }}</span></p>
                                    @endif
                                @endif

                                @if($data->email)
                                <p class="text-muted mb-2 font-13"><i class="fe-mail mr-1"></i> <strong>Alamat Email :</strong> <span class="ml-2">{{ $data->email }}</span></p>
                                @endif

                                @if(Auth::User()->roles->first->name->name)
                                <p class="text-muted mb-2 font-13"><i class="fe-user mr-1"></i> <strong>Peran Pengguna :</strong> <span class="ml-2">{{ Auth::User()->roles->first->name->name }}</span></p>
                                @endif

                            </div>

                            <ul class="social-list list-inline mt-3 mb-0">

                                @if($data->instagram)
                                <li class="list-inline-item">
                                    <a href="{{ $data->instagram ?? 'https://instagram.com' }}" target="_blank" class="social-list-item border-dark text-dark"><i class="mdi mdi-instagram"></i></a>
                                </li>
                                @endif
                                @if($data->facebook)
                                <li class="list-inline-item">
                                    <a href="{{ $data->facebook ?? 'https://facebook.com' }}" target="_blank" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                </li>
                                @endif
                                @if($data->wa_channel)
                                <li class="list-inline-item">
                                    <a href="{{ $data->wa_channel ?? 'https://whatsapp.com' }}" target="_blank" class="social-list-item border-success text-success"><i class="mdi mdi-whatsapp"></i></a>
                                </li>
                                @endif
                                @if($data->youtube)
                                <li class="list-inline-item">
                                    <a href="{{ $data->youtube ?? 'https://youtube.com' }}" target="_blank" class="social-list-item border-danger text-danger"><i class="mdi mdi-youtube"></i></a>
                                </li>
                                @endif

                            </ul>
                        </div> <!-- end card-box -->

                    </div> <!-- end col-->

                    <div class="col-lg-8 col-xl-8">
                        <div class="card-box">

                            <div class="row">

                                <div class="col-12">

                                    

                                    
                                    <!-- informasi hak akses -->
                                    <h5 class="mt-4 text-uppercase text-primary h4">
                                        <i class="fe-lock mr-1"></i> Informasi Hak Akses
                                    </h5>
                                    <hr>

                                    <!-- Alamat Email -->
                                    <div class="mb-3">
                                        <label for="email">Alamat Email <span class="text-danger">*</span></label>
                                        <input type="text" id="email" name="email" class="form-control" 
                                            value="{{ old('email', $data->email ?? '') }}" placeholder="Alamat Email">
                                    </div> <!-- end input group-->

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                        <small class="text-muted d-block mt-1">
                                            Tulis password baru jika ingin mengganti password
                                        </small>
                                    </div> <!-- end input group-->


                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fe-save mr-1"></i> Simpan Perubahan
                                        </button>
                                        <a href="{{ route('adminklasis.beranda') }}" class="btn"> <i class="fe-arrow-left mr-1"></i> Kembali</a>
                                        
                                    </div> <!-- end input group-->

                                    {!! Form::close() !!}

                                    <!-- Include Modals -->
                                    @include('AdminKlasis.profil.modals.delete_foto_kantor_modal')
                                    @include('AdminKlasis.profil.modals.delete_foto_ketua_klasis_modal')
                                    @include('AdminKlasis.profil.modals.deleteFileStrukturOrganisasiModal')
                                    @include('AdminKlasis.profil.modals.deleteFileSaranaPrasaranaModal')

                                </div>

                            </div>

                        </div> <!-- end card-box-->

                    </div> <!-- end col -->
                </div>
                <!-- end row-->

            </div> <!-- container -->

        </div> <!-- content -->

        @include('layouts.includes.footer')

    </div>
@stop


@push('scripts')
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function previewFotoGereja(event) {
            var input = event.target;
            var reader = new FileReader();
            var spinner = document.getElementById('loading-spinner');
            var imgElement = document.getElementById('preview-fotoGereja');

            // Tampilkan spinner & sembunyikan gambar sementara
            spinner.style.display = 'block';
            imgElement.style.display = 'none';

            reader.onload = function(){
                setTimeout(function() { // Tunggu 1 detik sebelum menampilkan gambar
                    spinner.style.display = 'none';
                    imgElement.src = reader.result;
                    imgElement.style.display = 'block';
                }, 500);
            };

            reader.readAsDataURL(input.files[0]); // Baca file sebagai URL
        }
    </script>
@endpush