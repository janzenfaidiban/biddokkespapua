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
                                    Anggota Keluarga
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title text-capitalize">Anggota Keluarga</h4>
                    </div>
                    {!! display_bootstrap_alerts() !!}
                </div>
            </div>
            <!-- end breadcrumb -->

            <div class="accordion" id="accordionExample">
                <div class="card-box">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fe-info mr-1"></i> Informasi Jemaat
                    </button>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            
                        <table class="table table-bordered p-0 m-0">
                            <tr>
                                <td width="20%"><i class="fe-flag mr-1"></i> Nama Klasis</td>
                                <td><b>{{ $keluarga->jemaat->klasis->nama_klasis ?? '' }}</b></td>
                            </tr>
                            <tr>
                                <td width="20%"><i class="fa fa-church mr-1"></i> Nama Jemaat</td>
                                <td><b>{{ $keluarga->jemaat->nama_jemaat ?? '' }}</b>  <span class="mx-2">|</span> <a href="{{ route('adminjemaat.profil') }}"> <i class="fe-maximize-2 mr-1"></i>  Profil Jemaat</a></td>
                            </tr>
                            <tr>
                                <td><i class="fe-users mr-1"></i> Nomor Karu Keluarga</td>
                                <td><b>{{ $keluarga->no_kk ?? '' }}</b></td>
                            </tr>
                            <tr>
                                <td><i class="fe-users mr-1"></i> Jumlah Anggota Keluarga</td>
                                <td><b>{{ '...' }}</b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            @include('components.alert')

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        
                        <div class="row">
                            <div class="col-lg-6">
                                
                                <a href="{{ route('adminjemaat.keluarga.anggota.create', $keluarga->no_kk ?? '' ) }}" class="btn btn-primary waves-effect waves-light" >  
                                    {!! $iconTombolTambah ?? '' !!} Tambah
                                </a>

                                <?php $totalDataVariable = 'totalData' . ucfirst(Request::segment(2)); ?>

                                <a href="{{ route('adminjemaat.keluarga.anggota.index', $keluarga->no_kk ?? '' ) }}" class="btn btn-link @if(Request::segment(5) == '') text-primary @else text-dark @endif">  
                                    {!! $iconSemuaData ?? '' !!} Semua ({{ $totalData ?? '' }})
                                </a>
                                
                                <?php $totalDataTrashedVariable = 'totalData' . ucfirst(Request::segment(2)) . 'withTrashed'; ?>
                                <a href="{{ route('adminjemaat.keluarga.anggota.trash', $keluarga->no_kk ?? '' ) }}" class="btn btn-link @if(Request::segment(5) == 'tempat-sampah') text-primary @else text-dark @endif"> 
                                    {!! $iconTempatSampah ?? '' !!} Tempat Sampah ({{ $totalDataTrashed ?? '' }})
                                </a>
                                
                            </div>
                                                            
                            <div class="@if(Auth::user()->hasRole('adminmaster') || Auth::user()->hasRole('adminklasis') || Auth::user()->hasRole('adminjemaat')) col-lg-6 @else col-lg-12 @endif">
                                <form action="{{ route('adminjemaat.keluarga.anggota.index', Request::segment(3) ) }}" method="GET">
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="s" placeholder="Ketik nama atau nama lengkap" aria-label="Recipient's username" value="{{ request()->s ?? old('s') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-dark waves-effect waves-light" type="submit">{!! $iconPencarian ?? '' !!} Cari</button>
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
                                                <th>Nama Lengkap</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Hubungan Keluarga</th>
                                                <th>Intra</th>
                                                <th>Status Baptis</th>
                                                <th>Status Sidi</th>
                                                <th>Status Pernikahan</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Ulang Tahun</th>
                                                <th>Nomor HP</th>
                                                <th>Email</th>
                                                <th>Suku</th>
                                                <th>Status Domisili</th>
                                                <th>Pendidikan Terakhir</th>
                                                <th>Golongan Darah</th>
                                                <th>Gelar Depan</th>
                                                <th>Gelar Belakang</th>
                                                <th>Jenis Pekerjaan</th>
                                                <th>Penyandang Cacat</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @forelse ($datas as $data)
                                            <tr>
                                                <td>{{ ++$i }}</td> 
                                                <td> {{ $data->nama_depan ?? '' }} {{ $data->nama_tengah ?? '' }} {{ $data->nama_belakang ?? '' }} </td>
                                                <td> {{ $data->jenis_kelamin ?? '' }} </td>
                                                <td> {{ $data->hubungankeluarga->hubungankeluarga ?? '' }} </td>
                                                <td> {{ $data->intra->intra ?? '' }} </td>
                                                <td> {{ $data->statusbaptis->statusbaptis ?? '' }} </td>
                                                <td> {{ $data->statussidi->statussidi ?? '' }} </td>
                                                <td> {{ $data->statuspernikahan->statuspernikahan ?? '' }} </td>
                                                <td> {{ $data->tanggal_lahir ?? '' }} </td>
                                                <td> {!! $data->hari_menuju_ultah !== null ? '<i class="fas fa-birthday-cake"></i> '.$data->hari_menuju_ultah . ' hari lagi' : '' !!} </td>
                                                <td> {{ $data->nomor_hp ?? '' }} </td>
                                                <td> {{ $data->email ?? '' }} </td>
                                                <td title="{{ $data->suku->keterangan ?? '' }}"> {{ $data->suku->suku ?? '' }} </td>
                                                <td title="{{ $data->statusdomisili->keterangan ?? '' }}"> {{ $data->statusdomisili->statusdomisili ?? '' }} </td>
                                                <td title="{{ $data->pendidikanterakhir->keterangan ?? '' }}"> {{ $data->pendidikanterakhir->pendidikanterakhir ?? '' }} </td>
                                                <td title="{{ $data->golongandarah->keterangan ?? '' }}"> {{ $data->golongandarah->golongandarah ?? '' }} </td>
                                                <td title="{{ $data->gelardepan->keterangan ?? '' }}"> {{ $data->gelardepan->gelardepan ?? '' }} </td>
                                                <td title="{{ $data->gelarbelakang->keterangan ?? '' }}"> {{ $data->gelarbelakang->gelarbelakang ?? '' }} </td>
                                                <td title="{{ $data->jenispekerjaan->keterangan ?? '' }}"> {{ $data->jenispekerjaan->jenispekerjaan ?? '' }} </td>
                                                <td title="{{ $data->penyandangcacat->keterangan ?? '' }}"> {{ $data->penyandangcacat->penyandangcacat ?? '' }} </td>

                                                @if(Request::segment(5) == 'tempat-sampah')

                                                
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <form action="{{ route('adminjemaat.keluarga.anggota.restore', $data->id ?? '') }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-success">
                                                                {!! $iconTombolKembalikan ?? '' !!} Kembalikan
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

                                                    <a href="{{ route('adminjemaat.keluarga.anggota.show', $data->id ?? '') }}" class="btn btn-success">
                                                        {!! $iconTombolDetail ?? '' !!} Detail
                                                    </a>
                                                    
                                                    <a href="{{ route('adminjemaat.keluarga.anggota.edit', $data->id ?? '') }}" class="btn btn-warning">
                                                        {!! $iconTombolUbah ?? '' !!}
                                                    </a>

                                                    <form action="{{ route('adminjemaat.keluarga.anggota.destroy', $data->id ?? 1) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            {!! $iconTombolHapus ?? '' !!}
                                                        </button>
                                                    </form>

                                                </td>
                                                @endif
                                                    
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

                                                                <form action="{{ route('adminjemaat.keluarga.anggota.forceDelete', $data->id ?? '') }}" method="POST" class="d-inline">
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
                                                <td colspan="21"><p>Tidak ada data yang tersedia</p></td>
                                            </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    @include('layouts.includes.footer')

</div>

@stop
