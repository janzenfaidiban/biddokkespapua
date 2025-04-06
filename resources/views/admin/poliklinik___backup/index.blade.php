@extends('layouts.app')

@section('head')

        {{-- additional scripts inside head element --}}

@endsection

@section('content')

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid"> 

        <x-page-title 
            :title="$pageTitle"
            :description="$pageDescription" 
        />


        <div class="row">
            <div class="col-xl-12">
                <div class="card-box">

                <x-admin.toolbar 
                    :iconTombolTambah="$iconTombolTambah"
                    :iconSemuaData="$iconSemuaData"
                    :iconTempatSampah="$iconTempatSampah"
                    :iconPencarian="$iconPencarian"
                    :totalAll="$totalAll ?? 0"
                    :totalOnlyTrashed="$totalOnlyTrashed ?? 0"
                    :routeSemua="route('admin.poliklinik.index')"
                    :routeTrash="route('admin.poliklinik.trash')"
                    :isSemuaActive="Request::segment(3) == ''"
                    :isTrashActive="Request::segment(3) == 'trash'"
                    :formAction="Request::segment(3) == 'trash' 
                        ? route('admin.poliklinik.trash') 
                        : route('admin.poliklinik.index')"
                />






          
                            
                    <div class="row">

                        <div class="col-12">

                            <!-- table responsive start -->
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                    
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>{!! $pageTitle !!}</th>
                                            <th>Alamat</th>
                                            <th>Nama Kepala</th>
                                            <th>Nomor Telepon</th>
                                            <th>Email</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($datas as $data )
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{ $data->nama_poliklinik ?? ''}}</td>
                                            <td>{{ $data->alamat ?? ''}}</td>
                                            <td>{{ $data->nama_kepala ?? ''}}</td>
                                            <td>{{ $data->no_telp ?? ''}}</td>
                                            <td>{{ $data->email ?? ''}}</td>

                                            <td class="text-right">
                                                <button type="button" class="btn btn-outline-dark"
                                                    data-toggle="modal"
                                                    data-target="#detailModal{{ $data->id }}">
                                                    {!! $iconTombolDetail !!}
                                                </button>
                                                <a href="#" class="btn"
                                                    data-toggle="modal"
                                                    data-target="#ubahModal{{ $data->id }}">
                                                    {!! $iconTombolUbah !!}
                                                </a>
                                                <a href="#" class="btn" data-toggle="modal" data-target="#hapusModal-{{ $data->id }}">
                                                    {!! $iconTombolHapus !!}
                                                </a>
                                            </td>
                                        </tr>




                                        @include('admin.poliklinik.modals.ubah')
                                        @include('admin.poliklinik.modals.detail')
                                        @include('admin.poliklinik.modals.hapus')

                                        

                                        @empty
                                        <tr>
                                            <td><p>Tidak ada data yang tersedia</p></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="mt-3">
                                    {{-- {{ $datas->links() }} --}}
                                </div>

                            </div>
                            <!-- table-responsive end -->

                        </div>
                        <!-- .col end -->
                            
                    </div>
                    <!-- .row end -->









                </div>
            </div>
        </div>































            
        </div> <!-- container -->

    </div> <!-- content -->

    <x-footer />


    @include('admin.poliklinik.modals.tambah')















</div>

@stop

@push('scripts')
    

{{-- additional scripts above of the end of the body element </body> --}}
       
        

@endpush
