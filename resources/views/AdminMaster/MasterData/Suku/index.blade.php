@extends('layouts.app')
@section('content')

    <div class="content-page">

        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                @include('AdminMaster.MasterData.breadcrumb')
                @include('components.alert')
                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-lg-6">
                                    
                                    <a href="{{ route('adminmaster.masterdata.suku.create') }}" class="btn btn-primary waves-effect waves-light" >  <i class="fas fa-plus-circle"></i> Tambah</a>

                                    <?php $totalDataVariable = 'totalData' . ucfirst(Request::segment(2)); ?>
                                    <a href="{{ route('adminmaster.masterdata.suku')}}" class="btn btn-link @if(Request::segment(3) == '') text-primary @else text-dark @endif">  <i class="fas fa-bars mr-1"></i>
                                        Semua ({{ $totalData }})
                                    </a>
                                    
                                    <?php $totalDataTrashedVariable = 'totalData' . ucfirst(Request::segment(2)) . 'withTrashed'; ?>
                                    <a href="{{ route('adminmaster.masterdata.suku.trash') }}" class="btn btn-link @if(Request::segment(3) == 'trash') text-primary @else text-dark @endif"> <i class="fas fa-trash mr-1"></i>
                                        Tempat Sampah ({{ $totalDataTrashed }})
                                    </a>
                                    
                                </div>
                                                                
                                <div class="col-lg-6">
                                    <form action="{{ Request::segment(3) == 'trash' ? route('adminmaster.masterdata.suku.trash') : route('adminmaster.masterdata.suku') }}" method="GET">
                                        <div class="form-group mb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="s" placeholder="Tulis kata kunci" aria-label="Recipient's username" value="{{ request()->s ?? old('s') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark waves-effect waves-light" type="submit">Cari</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- .row end -->
                            
                            <div class="row">

                                <div class="col-12">

                                    <!-- table responsive start -->
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                            
                                            <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>{!! $pageTitle !!}</th>
                                                <th>Keterangan</th>
                                                @if(Request::segment(3) == 'trash')
                                                <th>Dihapus pada</th>
                                                @else
                                                <th>Dibaharui pada</th>
                                                @endif
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($datas as $data )
                                            <tr>
                                                <td>{{++$i}}</td>
                                                <td>{{ $data->suku ?? ''}}</td>
                                                <td>{{ $data->keterangan ?? '' }}</td>
                                                @if(Request::segment(3) == 'trash')
                                                <td>{{ \Carbon\Carbon::parse($data->deleted_at)->diffForHumans() }} / {{ \Carbon\Carbon::parse($data->deleted_at)->translatedFormat('l, d F Y') }}</td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <form action="{{ route('adminmaster.masterdata.suku.restore', $data->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-success"><i class="fas fa-arrow-left"></i> Kembalikan</button>
                                                        </form>
                                                        
                                                        <!-- delete button to open the confirmation modal -->
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('adminmaster.masterdata.suku.forceDelete', $data->id) }}')">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                                @else
                                                <td>{{ \Carbon\Carbon::parse($data->updated_at)->diffForHumans() }} / {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('l, d F Y') }}</td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{route('adminmaster.masterdata.suku.show', $data->id ?? '' ) }}" class="btn btn-success" > <i class="fas fa-eye"></i>  Detail</a>
                                                        
                                                        @if($data->default == FALSE)
                                                        <a href="{{route('adminmaster.masterdata.suku.edit', $data->id ?? '' ) }}" class="btn btn-warning" ><i class="fas fa-pencil-alt"></i></a>

                                                        <form action="{{ route('adminmaster.masterdata.suku.destroy', $data->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </td>
                                                @endif
                                            </tr>

                                            @empty
                                            <tr>
                                                <td><p>Tidak ada data yang tersedia</p></td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                        </table>

                                        <div class="mt-3">
                                            {{ $datas->links() }}
                                        </div>

                                    </div>
                                    <!-- table-responsive end -->

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
                                <!-- .col end -->
                                    
                            </div>
                            <!-- .row end -->

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        @include('layouts.includes.footer')

    </div>

@stop

@push('scripts')
<script>
    function confirmDelete(url) {
        $('#deleteForm').attr('action', url);
        $('#deleteModal').modal('show');
    }
</script>
@endpush