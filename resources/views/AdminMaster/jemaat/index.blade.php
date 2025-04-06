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
                                <div class="col-lg-6">
                                    
                                    <a href="{{ route('adminmaster.jemaat.create') }}" class="btn btn-primary waves-effect waves-light" >
                                        {!! $iconTombolTambah !!} Tambah
                                    </a>

                                    <?php $totalDataVariable = 'totalData' . ucfirst(Request::segment(2)); ?>
                                    <a href="{{ route('adminmaster.jemaat.index')}}" class="btn btn-link @if(Request::segment(3) == '') text-primary @else text-dark @endif">
                                        {!! $iconSemuaData !!}  Semua ({{ $totalData }})
                                    </a>
                                    
                                    <?php $totalDataTrashedVariable = 'totalData' . ucfirst(Request::segment(2)) . 'withTrashed'; ?>
                                    <a href="{{ route('adminmaster.jemaat.trash') }}" class="btn btn-link @if(Request::segment(3) == 'trash') text-primary @else text-dark @endif">
                                        {!! $iconTempatSampah !!} Tempat Sampah ({{ $totalDataTrashed }})
                                    </a>
                                    
                                </div>
                                                                
                                <div class="col-lg-6">
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
                                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                            
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center" class="text-center">Nama Jemaat</th>
                                                    <th class="text-center" class="text-center">Pendeta Jemaat</th>
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

                                                    @if(Request::segment(3) == 'trash')
                                                    <td>
                                                        <div class="d-flex justify-content-end gap-1">
                                                            <form action="{{ route('adminmaster.jemaat.restore', $data->id) }}" method="POST" class="d-inline">
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
                                                            <a href="{{route('adminmaster.jemaat.show', $data->id ?? '' ) }}" class="btn btn-success" >
                                                                {!! $iconTombolDetail !!} Detail
                                                            </a>
                                                            <a href="{{route('adminmaster.jemaat.edit', $data->id ?? '' ) }}" class="btn btn-warning" >
                                                                {!! $iconTombolUbah !!} 
                                                            </a>
                                                            <form action="{{ route('adminmaster.jemaat.destroy', $data->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    {!! $iconTombolHapus !!}
                                                                </button>
                                                            </form>
                                                        </div>
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

                                                                <form action="{{ route('adminmaster.jemaat.forceDelete', $data->id) }}" method="POST" class="d-inline">
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
                                            {{-- {{ $datas->links() }} --}}
                                        </div>

                                        <!-- modal delete confirmation start -->
                                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data ini secara permanen? <b>Tindakan ini tidak dapat dibatalkan setelah Anda klik tombol Hapus</b>.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <form id="deleteForm" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal delete confirmation end -->

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

@stop
