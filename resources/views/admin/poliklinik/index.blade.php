@extends('layouts.app')

@section('content')

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid"> 

            <x-page-title 
                :title="$pageTitle"
                :description="$pageDescription" 
            />
                
            {!! display_bootstrap_alerts() !!}

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
                                                <th>Nama Poliklinik</th>
                                                <th>Alamat</th>
                                                <th>Nama Kepala</th>
                                                <th>No. Telp</th>
                                                <th>Email</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($datas as $data )
                                            <tr>
                                                <td>{{++$i}}</td>
                                                <td>{{ $data->nama_poliklinik }}</td>
                                                <td>{{ $data->alamat }}</td>
                                                <td>{{ $data->nama_kepala }}</td>
                                                <td>{{ $data->no_telp }}</td>
                                                <td>{{ $data->email }}</td>

                                                <x-admin.action-buttons
                                                    :data="$data"
                                                    :action="route('admin.poliklinik.restore', $data->id)"
                                                    :icon-tombol-detail="$iconTombolDetail"
                                                    :icon-tombol-ubah="$iconTombolUbah"
                                                    :icon-tombol-hapus="$iconTombolHapus"
                                                    :icon-tombol-kembalikan="$iconTombolKembalikan"
                                                    :icon-tombol-hapus-permanen="$iconTombolHapusPermanen"
                                                />

                                            </tr>

                                            <!-- komponen modal ubah -->
                                            <x-modals.modal-edit
                                                :modalId="'ubahModal' . $data->id"
                                                title="Ubah Poliklinik"
                                                :formAction="route('admin.poliklinik.update', $data->id)"
                                                :data="$data"
                                                :fields="[
                                                    ['name' => 'nama_poliklinik', 'label' => 'Nama Poliklinik'],
                                                    ['name' => 'alamat', 'label' => 'Alamat'],
                                                    ['name' => 'nama_kepala', 'label' => 'Nama Kepala'],
                                                    ['name' => 'no_telp', 'label' => 'No. Telp'],
                                                    ['name' => 'email', 'label' => 'Email'],
                                                    ['name' => 'password', 'label' => 'Password', 'type' => 'password'],
                                                ]"
                                            />

                                            <!-- komponen modal detail -->
                                            <x-modals.modal-detail 
                                                :id="$data->id"
                                                title="Detail Poliklinik"
                                                :items="[
                                                    'Nama Poliklinik' => $data->nama_poliklinik,
                                                    'Alamat' => $data->alamat,
                                                    'Nama Kepala' => $data->nama_kepala,
                                                    'No. Telp' => $data->no_telp,
                                                    'Email' => $data->email,
                                                    'Dibuat' => \Carbon\Carbon::parse($data->created_at)->translatedFormat('l, d F Y H:i'),
                                                    'Diubah Terakhir' => \Carbon\Carbon::parse($data->updated_at)->diffForHumans(),
                                                ]"
                                            />

                                            <!-- komponen modal hapus -->
                                            <x-modals.modal-hapus 
                                                :id="$data->id"
                                                :action="route('admin.poliklinik.softDelete', $data->id)"
                                                itemName="{{ $data->nama_poliklinik }}"
                                                title="Hapus Poliklinik"
                                                message="Apakah Anda yakin ingin menghapus"
                                            />

                                            <!-- komponen modal hapus permanen -->
                                            <x-modals.modal-hapus-permanen 
                                                :id="$data->id"
                                                :action="route('admin.poliklinik.forceDelete', $data->id)"
                                                itemName="{{ $data->nama_poliklinik }}"
                                                title="Hapus Poliklinik Secara Permanen"
                                                message="Apakah Anda yakin ingin menghapus secara permanen"
                                            />

                                            @empty
                                            <tr>
                                                <td colspan="7"><p class="text-center">Tidak ada data yang tersedia</p></td>
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
                                
                        </div>

                    </div>
                </div>
            </div>

        </div> <!-- container -->

    </div> <!-- content -->

    <x-footer />

    <!-- komponen modal tambah -->
    <x-modals.modal-create
        modalId="tambahModal"
        title="Tambah Poliklinik"
        formAction="{{ route('admin.poliklinik.store') }}"
        :fields="[
            ['name' => 'nama_poliklinik', 'label' => 'Nama Poliklinik'],
            ['name' => 'alamat', 'label' => 'Alamat'],
            ['name' => 'nama_kepala', 'label' => 'Nama Kepala'],
            ['name' => 'no_telp', 'label' => 'No. Telp'],
            ['name' => 'email', 'label' => 'Email'],
            ['name' => 'password', 'label' => 'Password', 'type' => 'password'],
        ]"
    />

</div>

@stop
