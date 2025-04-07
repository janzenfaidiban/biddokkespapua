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
                        :routeSemua="route('admin.barang.index')"
                        :routeTrash="route('admin.barang.trash')"
                        :isSemuaActive="Request::segment(3) == ''"
                        :isTrashActive="Request::segment(3) == 'trash'"
                        :formAction="Request::segment(3) == 'trash' 
                            ? route('admin.barang.trash') 
                            : route('admin.barang.index')"
                    />

                        <div class="row">

                            <div class="col-12">

                                <!-- table responsive start -->
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                        
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th>Harga Satuan</th>
                                                <th>Keterangan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($datas as $data )
                                            <tr>
                                                <td>{{++$i}}</td>
                                                <td>{{ $data->nama_barang ?? ''}}</td>
                                                <td>{{ $data->kategori ?? ''}}</td>
                                                <td>{{ $data->harga_satuan ?? ''}}</td>
                                                <td>{{ $data->keterangan ?? ''}}</td>

                                                <x-admin.action-buttons
                                                    :data="$data"
                                                    :action="route('admin.barang.restore', $data->id)"
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
                                                title="Ubah Barang"
                                                :formAction="route('admin.barang.update', $data->id)"
                                                :data="$data"
                                                :fields="[
                                                    ['name' => 'nama_barang', 'label' => 'Nama Barang'],
                                                    ['name' => 'kategori', 'label' => 'Kategori', 'type' => 'select', 'options' => ['obat' => 'Obat', 'bhp' => 'Bahan Habis Pakai']],
                                                    ['name' => 'harga_satuan', 'label' => 'Harga Satuan', 'type' => 'number', 'min' => 0],
                                                    ['name' => 'keterangan', 'label' => 'Keterangan', 'type' => 'textarea'],
                                                ]"
                                            />

                                            <!-- komponen modal detail -->
                                            <x-modals.modal-detail 
                                                :id="$data->id"
                                                title="Detail Barang"
                                                :items="[
                                                    'Nama Barang' => $data->nama_barang,
                                                    'Kategori' => $data->kategori,
                                                    'Harga Satuan' => $data->harga_satuan,
                                                    'Keterangan' => $data->keterangan,
                                                    'Dibuat' => \Carbon\Carbon::parse($data->created_at)->translatedFormat('l, d F Y H:i'),
                                                    'Diubah Terakhir' => \Carbon\Carbon::parse($data->updated_at)->diffForHumans(),
                                                ]"
                                            />

                                            <!-- komponen modal hapus -->
                                            <x-modals.modal-hapus 
                                                :id="$data->id"
                                                :action="route('admin.barang.softDelete', $data->id)"
                                                itemName="{{ $data->nama_barang }}"
                                                title="Hapus Barang"
                                                message="Apakah Anda yakin ingin menghapus"
                                            />

                                            <!-- komponen modal hapus permanen -->
                                            <x-modals.modal-hapus-permanen 
                                                :id="$data->id"
                                                :action="route('admin.barang.forceDelete', $data->id)"
                                                itemName="{{ $data->nama_barang }}"
                                                title="Hapus Barang Secara Permanen"
                                                message="Apakah Anda yakin ingin menghapus secara permanen"
                                            />

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

    <!-- komponen modal tambah -->
    <x-modals.modal-create
        modalId="tambahModal"
        title="Tambah Barang"
        formAction="{{ route('admin.barang.store') }}"
        :fields="[
            ['name' => 'nama_barang', 'label' => 'Nama Barang'],
            ['name' => 'kategori', 'label' => 'Kategori', 'type' => 'select', 'options' => ['obat' => 'Obat', 'bhp' => 'Bahan Habis Pakai']],
            ['name' => 'harga_satuan', 'label' => 'Harga Satuan', 'type' => 'number', 'min' => 0, 'value' => 0],
            ['name' => 'keterangan', 'label' => 'Keterangan', 'type' => 'textarea'],
        ]"
    />


</div>

@stop
