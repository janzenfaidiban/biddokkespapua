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
                
                @include('components.alert')
             
                {!! display_bootstrap_alerts() !!}

                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-lg-6">
                                    
                                    <a href="{{ route('adminmaster.klasis.create') }}" class="btn btn-primary waves-effect waves-light" >
                                        {!! $iconTombolTambah !!} Tambah
                                    </a>

                                    <?php $totalDataVariable = 'totalData' . ucfirst(Request::segment(2)); ?>
                                    <a href="{{ route('adminmaster.klasis.index')}}" class="btn btn-link @if(Request::segment(3) == '') text-primary @else text-dark @endif">
                                        {!! $iconSemuaData !!} Semua ({{ $totalData }})
                                    </a>

                                    
                                    <?php $totalDataTrashedVariable = 'totalData' . ucfirst(Request::segment(2)) . 'withTrashed'; ?>
                                    <a href="{{ route('adminmaster.klasis.trash') }}" class="btn btn-link @if(Request::segment(3) == 'trash') text-primary @else text-dark @endif">
                                        {!! $iconTempatSampah !!} Tempat Sampah ({{ $totalDataTrashed }})
                                    </a>
                                    
                                </div>
                                                                
                                <div class="col-lg-6">
                                    <form action="{{ Request::segment(3) == 'trash' ? url(Request::segment(1).'/'.Request::segment(2).'/trash') : url(Request::segment(1).'/'.Request::segment(2)) }}" method="GET">
                                        <div class="form-group mb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="s" placeholder="Ketik nama klasis " aria-label="Recipient's username" value="{{ request()->s ?? old('s') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark waves-effect waves-light" type="submit">{!! $iconPencarian !!}Cari</button>
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
                                                    <th>Foto Kantor</th>
                                                    <th>Nama Klasis</th>
                                                    <th>Jumlah Jemaat</th>
                                                    <th>Jumlah Keluarga</th>
                                                    <th>Jumlah Anggota Keluarga</th>
                                                    <th>Alamat Email</th>
                                                    @if(Request::segment(3) == 'trash')
                                                    <th>Dihapus pada</th>
                                                    @else
                                                    <th>Dibaharui pada</th>
                                                    @endif
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @forelse ($datas as $data)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td width="200">
                                                        @if(isset($data->user) && $data->user->fotoKantor)
                                                        <img src="{{ asset('storage/' . $data->user->fotoKantor) }}" alt="Foto kantor" class="w-100 img-thumbnail">
                                                        @else
                                                        <img src="{{ asset('assets/images/gambar-placeholder.jpg') }}" alt="Foto kantor" class="w-100 img-thumbnail">
                                                        @endif
                                                    </td>
                                                    <td>{!! $data->nama_klasis !!}</td>
                                                    <td>{!! '<small>...</small>' !!}</td>
                                                    <td>{!! '<small>...</small>' !!}</td>
                                                    <td>{!! '<small>...</small>' !!}</td>
                                                    <td>{!! '<small>...</small>' !!}</td>

                                                    @if(Request::segment(3) == 'trash')
                                                    <td>{{ \Carbon\Carbon::parse($data->deleted_at)->diffForHumans() }} / {{ \Carbon\Carbon::parse($data->deleted_at)->translatedFormat('l, d F Y') }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-end gap-1">
                                                            <form action="{{ route('adminmaster.klasis.restore', $data->id) }}" method="POST" class="d-inline">
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
                                                    <td>{{ \Carbon\Carbon::parse($data->updated_at)->diffForHumans() }} / {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('l, d F Y') }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-end gap-1">
                                                            <a href="{{route('adminmaster.klasis.show', $data->id ?? '' ) }}" class="btn btn-success" >
                                                                {!! $iconTombolDetail !!} Detail
                                                            </a>
                                                            <a href="{{route('adminmaster.klasis.edit', $data->id ?? '' ) }}" class="btn btn-warning" >
                                                                {!! $iconTombolUbah !!} Ubah
                                                            </a>
                                                            <form action="{{ route('adminmaster.klasis.destroy', $data->id) }}" method="POST" class="d-inline">
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

                                                                <form action="{{ route('adminmaster.klasis.forceDelete', $data->id) }}" method="POST" class="d-inline">
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
