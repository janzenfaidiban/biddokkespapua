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

                                <div class="col-12">

                                    <!-- table responsive start -->
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                            
                                            <thead class="thead-light">
                                            <tr>
                                                <th width="1">No</th>
                                                <th width="200">{!! $pageTitle !!}</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($datas as $data )
                                            <tr>
                                                <td>{{++$i}}</td>
                                                <td>{{ $data->golongandarah ?? ''}}</td>
                                                <td>{{ Str::words($data->keterangan ?? '', 10, '...') }}</td>
                                            </tr>

                                            @empty
                                            <tr>
                                                <td><p>Tidak ada data yang tersedia</p></td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                        </table>

                                    </div>
                                    <!-- table-responsive end -->

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