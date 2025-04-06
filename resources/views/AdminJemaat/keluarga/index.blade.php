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

                <div class="accordion" id="accordionExample">
                    <div class="card-box">
                        <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fe-info mr-1"></i> Informasi Jemaat
                        </button>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <table class="table table-bordered p-0 m-0 mt-2">
                                <tr>
                                    <td width="20%"><i class="fe-flag mr-1"></i> Nama Klasis</td>
                                    <td><b>{{ $loggedUser->klasis->nama_klasis ?? '' }}</b></td>
                                </tr>
                                <tr>
                                    <td width="20%"><i class="fa fa-church mr-1"></i> Nama Jemaat</td>
                                    <td><b>{{ $loggedUser->nama_jemaat ?? '' }}</b> <span class="mx-2">|</span> <a href="{{ route('adminjemaat.profil') }}"> <i class="fe-maximize-2 mr-1"></i>  Profil Jemaat</a></td>
                                </tr>
                                <tr>
                                    <td><i class="fe-users mr-1"></i> Jumlah Keluarga</td>
                                    <td><b>{{ $totalData }} Kepala Keluarga</b></td>
                                </tr>
                                <tr>
                                    <td><i class="fe-users mr-1"></i> Jumlah Anggota Keluarga</td>
                                    <td><b>{{ $totalAnggotaKeluarga }} Orang ({{ $anggotaKeluargaLakiLaki }} Laki-Laki, Perempuan: {{ $anggotaKeluargaPerempuan }} Perempuan)</b></td>
                                </tr>
                            </table>
                        </div>

                        
                    </div>
                </div>

                @include('components.alert')

                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-lg-6">
                                    
                                    
                                    <a href="{{ route('adminjemaat.keluarga.create', $loggedUser->id) }}" class="btn btn-primary waves-effect waves-light">
                                        {!! $iconTombolTambah !!} Tambah
                                    </a>

                                    <?php $totalDataVariable = 'totalData' . ucfirst(Request::segment(2)); ?>
                                    <a href="{{ route('adminjemaat.keluarga.index')}}" class="btn btn-link @if(Request::segment(3) == '') text-primary @else text-dark @endif">
                                        {!! $iconSemuaData !!} Semua ({{ $totalData }})
                                    </a>
                                    
                                    <?php $totalDataTrashedVariable = 'totalData' . ucfirst(Request::segment(2)) . 'withTrashed'; ?>
                                    <a href="{{ url('adminjemaat/keluarga/tempat-sampah') }}" class="btn btn-link @if(Request::segment(3) == 'tempat-sampah') text-primary @else text-dark @endif">
                                        {!! $iconTempatSampah !!} Tempat Sampah ({{ $totalDataTrashed }})
                                    </a>
                                    
                                </div>
                                                                
                                <div class="@if(Auth::user()->hasRole('adminmaster') || Auth::user()->hasRole('adminklasis') || Auth::user()->hasRole('adminjemaat')) col-lg-6 @else col-lg-12 @endif">
                                    <form action="{{ Request::segment(3) == 'tempat-sampah' ? url(Request::segment(1).'/'.Request::segment(2).'/tempat-sampah') : url(Request::segment(1).'/'.Request::segment(2)) }}" method="GET">
                                        <div class="form-group mb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="s" placeholder="Ketik No KK atau nama kepala keluarga" aria-label="Recipient's username" value="{{ request()->s ?? old('s') }}">
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
                                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                            
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>No KK</th>
                                                    <th>Nama Kepala Keluarga</th>
                                                    <th>Anggota Keluarga</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @forelse ($datas as $data)
                                                <tr class="">
                                                    <td>{{ ++$i }}</td>
                                                    <td class="font-weight-bold">
                                                        {{ $data->no_kk ?? "" }}
                                                    </td>
                                                    <td>

                                                        @if($data->anggotakeluarga->pluck('nama_depan')->implode(', '))

                                                        <i class="fe-user"></i>
                                                        {{ $data->anggotakeluarga->pluck('nama_depan')->implode(', ') }}
                                                        {{ $data->anggotakeluarga->pluck('nama_tengah')->implode(', ') }}
                                                        {{ $data->anggotakeluarga->pluck('nama_belakang')->implode(', ') }}
                                                        
                                                        <small class="d-block">
                                                            {{ $data->anggotakeluarga->pluck('hubungankeluarga.hubungankeluarga')->implode(', ') }}
                                                        </small>

                                                        @else
                                                        <small>Belum ditentukan</small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data->anggotakeluarga()->count() == 0)
                                                        <small>Belum ada data</small>
                                                        @else 
                                                        {{ $data->anggotakeluarga()->count() }}
                                                        @endif
                                                    </td>
                                                    
                                                    <!-- ================= TOMBOL AKSI =================
                                                        Jika segment 2 adalah tempat-sampah, maka tampilkan tombol Kembalikan dan Hapus Permanen
                                                        Jika segment 2 bukan tempat-sampah, maka tampilkan tombol Detail, Edit, dan Hapus   
                                                    -->
                                                    @if(Request::segment(3) == 'tempat-sampah')
                                                    <td>
                                                        <div class="d-flex justify-content-end gap-1">
                                                            <form action="{{ route('adminjemaat.keluarga.restore', $data->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-success">
                                                                    {!! $iconTombolKembalikan !!} Kembalikan
                                                                </button>
                                                            </form>

                                                            <!-- tombol modal -->
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$data->id}}">
                                                                {!! $iconTombolHapusPermanen !!} Hapus Permanen
                                                            </button>

                                                        </div>
                                                    </td>

                                                    @else
                                                    <td>
                                                        <div class="d-flex justify-content-end gap-1">
                                                            <a href="{{ route('adminjemaat.keluarga.anggota.index', $data->no_kk) }}" class="btn btn-primary" >
                                                                <i class="fe-users"></i> Anggota Keluarga
                                                            </a>
                                                            <a href="{{route('adminjemaat.keluarga.show', $data->id ?? '' ) . '?jemaat_id='. $loggedUser->id }}" class="btn btn-success" >
                                                                {!! $iconTombolDetail !!} Detail</a>
                                                            @if(Auth::user()->hasRole('adminmaster') || Auth::user()->hasRole('adminklasis') || Auth::user()->hasRole('adminjemaat'))
                                                                <a href="{{route('adminjemaat.keluarga.edit', $data->id ?? '' ) . '?jemaat_id='. $loggedUser->id }}" class="btn btn-warning" >
                                                                    {!! $iconTombolUbah !!}
                                                                </a>

                                                                <form action="{{ route('adminjemaat.keluarga.destroy', $data->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        {!! $iconTombolHapus !!}
                                                                </button>
                                                                </form>

                                                            @endif
                                                        </div>
                                                    </td>

                                                    @endif
                                                    
                                                    <!-- ================= TOMBOL AKSI ================= -->

                                                </tr>

                                                <!-- modal konfirmasi hapus -->
                                                <div class="modal fade" id="deleteModal-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title text-light" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini secara permanen? Data tidak dapat dikembalikan lagi setelah tindakan ini.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    {!! $iconBatal !!} Batal
                                                                </button>

                                                                <form action="{{ route('adminjemaat.keluarga.forceDelete', $data->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        {!! $iconTombolHapusPermanen !!} Ya, Hapus Permanen
                                                                    </button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @empty
                                                <tr>
                                                    <td colspan="5"><p>Tidak ada data yang tersedia</p></td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <div class="mt-3">
                                            {{ $datas->links() }}
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
