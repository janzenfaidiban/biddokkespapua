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
                                        <a  href="{{ route('adminklasis.beranda') }}">Beranda</a> 
                                    </li>
                                    <li class="breadcrumb-item text-capitalize active">
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
                    <div class="col-xl-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ Request::segment(3) == 'trash' ? url(Request::segment(1).'/'.Request::segment(2).'/trash') : url(Request::segment(1).'/'.Request::segment(2)) }}" method="GET">
                                        <div class="form-group mb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="s" placeholder="Ketik nama jemaat atau nama pendeta" aria-label="Recipient's username" value="{{ request()->s ?? old('s') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark waves-effect waves-light" type="submit">{!! $iconPencarian !!} Cari</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-nowrap m-0">
                                            
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Nama Jemaat</th>
                                                    <th class="text-center">Pendeta Jemaat</th>
                                                    <th class="text-center">Jumlah Keluarga</th>
                                                    <th class="text-center">Jumlah Anggota Keluarga</th>
                                                    <th class="text-center">Alamat Email</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @forelse ($datas as $data)
                                                <tr>
                                                    <td class="text-center">{{ ++$i }}</td>
                                                    <td class="text-center" width="200">
                                                        <p class="font-weight-bold">{!! $data->nama_jemaat ?? '' !!}</p>
                                                        @if(isset($data->user) && $data->user->fotoGereja)
                                                        <img src="{{ asset('storage/' . $data->user->fotoGereja) }}" alt="Foto Gereja" class="w-100 img-thumbnail">
                                                        @else
                                                        <img src="{{ asset('assets/images/gambar-placeholder.jpg') }}" alt="Foto Gereja" class="w-100 img-thumbnail">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{!! $data->user->namaPendeta ?? '<small>...</small>' !!}</p>
                                                        @if(isset($data->user) && $data->user->fotoPendeta)
                                                        <div class="square-container position-relative overflow-hidden">
                                                            <img src="{{ asset('storage/' . $data->user->fotoPendeta) }}" 
                                                                alt="Foto Gereja" 
                                                                class="rounded-circle img-thumbnail" 
                                                                style="object-fit: cover;" width="100" height="100">
                                                        </div>
                                                        @else
                                                        <div class="square-container position-relative overflow-hidden">
                                                            <img src="{{ asset('assets/images/gambar-placeholder-square.jpg') }}" 
                                                                alt="Foto Gereja" 
                                                                class="rounded-circle img-thumbnail" 
                                                                style="object-fit: cover;" width="100" height="100">
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{!! $data->keluarga->count() !!}</td>
                                                    <td class="text-center">{!! $data->anggotakeluarga->count() !!}</td>
                                                    <td class="text-center">{{ $data->user ? $data->user->email : '' }}</td>

                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a href="{{route('adminklasis.jemaat.show', $data->id ?? '' ) }}" class="btn btn-success" > 
                                                                {!! $iconTombolDetail !!} Detail
                                                        </a>
                                                            <a href="{{route('adminklasis.jemaat.edit', $data->id ?? '' ) }}" class="btn btn-warning" >
                                                                {!! $iconTombolUbah !!} Ubah
                                                            </a>
                                                            
                                                        </div>
                                                    </td>

                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5"><p>Tidak ada data yang tersedia</p></td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <div class="mt-3">
                                            {{-- {{ $datas->links() }} --}}
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


            </div> <!-- container -->

        </div> <!-- content -->

        @include('layouts.includes.footer')

    </div>

    <x-modal-alert/>

@stop

@push('scripts')
<script>
    function confirmDelete(url) {
        $('#deleteForm').attr('action', url);
        $('#deleteModal').modal('show');
    }
</script>
@endpush
